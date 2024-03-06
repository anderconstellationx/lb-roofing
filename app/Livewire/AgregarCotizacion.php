<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Mail\QuoteNotifyAdministratorFromClientDecision;
use App\Mail\QuoteNotifyClient;
use App\Mail\QuoteNotifyClientConstancy;
use App\Models\ClienteEstadoCotizacion;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use App\Models\Estado;
use App\Models\EstadoCotizacion;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Proyecto;
use App\Models\ProyectoEstado;
use App\Models\Rol;
use App\Models\TemplateCotizacion;
use App\Models\TemplateCotizacionItem;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AgregarCotizacion extends Component
{
    use GlobalMessage;
    protected $listeners = [
        'send-email-quote' => 'sendQuote'
    ];
    // from url
    public $id, $quoteId, $statusQuote, $quoteInfo, $isTemplate, $quoteTemplateId;

    //form values
    public string $name, $fechaEmision, $fechaVencimiento, $observaciones = '';

    public float $subTotal = 0, $descuento = 0, $total = 0, $tax = 0, $subtotalQuote = 0, $discountQuote = 0, $totalQuote;

    public int $status;

    // quote items
    public array $providers = [], $products = [], $items = [], $newItem = [];

    public function mount($id, $quote_id, $is_template = false)
    {
        $this->isTemplate = $is_template; // is template
        $this->id = $id; // project id
        $this->quoteId = $quote_id; // quote id
        $this->quoteTemplateId = request()->route()->parameter('quote_template_id'); // template quote id
        if ($this->quoteId || $this->quoteTemplateId) {
            $quote = $this->isTemplate ? TemplateCotizacion::findOrFail($this->quoteTemplateId) : Cotizacion::findOrFail($this->quoteId);
            if ($quote) {
                $this->quoteInfo = $quote;
                $this->fechaEmision = date('Y-m-d', strtotime($quote->fecha_emision));
                $this->fechaVencimiento = date('Y-m-d', strtotime($quote->fecha_vencimiento));
                $this->observaciones = $quote->observaciones;
                $this->name = $quote->name;
                if (!$this->isTemplate) {
                    $this->status = $quote->estado_cotizacion_id;
                }
                $this->subtotalQuote = $quote->subtotal;
                $this->total = $quote->subtotal;
                $this->discountQuote = $quote->descuento;
                $this->totalQuote = $quote->total;
            }

            if ($this->isTemplate) {
                $quoteItems = TemplateCotizacionItem::where([
                    'template_cotizacion_id' => $this->quoteTemplateId
                ])->with('producto.proveedor')->get();
            } else {
                $quoteItems = CotizacionItem::where([
                    'cotizacion_id' => $this->quoteId
                ])->with('producto.proveedor')->get();
            }

            if ($quoteItems) {
                foreach ($quoteItems as $item) {
                    $this->items[] = [
                        'id' => $item->id,
                        'product_id' => $item->producto->id,
                        'products' => $this->getProductsByProvider($item->producto->proveedor->id),
                        'provider_id' => $item->producto->proveedor->id,
                        'quote_id' => $this->quoteId,
                        'quantity' => $item->cantidad,
                        'price' => $item->precio,
                        'discount' => $item->descuento,
                        'tax_boolean' => $item->tax > 0,
                        'tax' => $item->tax,
                        'sub_total' => $item->sub_total,
                        'total' => $item->total,
                    ];
                }

                $this->calculatePrice();
            }
        }

        $this->products = Producto::all()->toArray();
        $this->providers = Proveedor::all()->toArray();
        $this->statusQuote = EstadoCotizacion::all()->toArray();

        $this->newItem = [
            'id' => 0,
            'product_id' => 0,
            'products' => [],
            'quote_id' => $this->quoteId,
            'quantity' => 1,
            'price' => 0,
            'discount' => 0,
            'tax_boolean' => false,
            'tax' => 0,
            'sub_total' => 0,
            'total' => 0,
        ];

        $this->fechaEmision = date('Y-m-d');
        $this->fechaVencimiento = date('Y-m-d', strtotime($this->fechaEmision . '+ 5 days'));
    }

    public function rules()
    {
        $required = $this->isTemplate ? '' : 'required';
        return [
            'name' => 'required',
            'status' => $required,
            'fechaEmision' => 'required|date',
            'fechaVencimiento' => 'required|date|after_or_equal:fechaEmision',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('lang.this_field_is_required'),
            'status.required' => __('lang.this_field_is_required'),
            'fechaEmision.required' => __('lang.this_field_is_required'),
            'fechaVencimiento.required' => __('lang.this_field_is_required'),
            'fechaVencimiento.after_or_equal' => __('lang.quote.expiration_date_validation_start_date'),
        ];
    }

    public function addQuote()
    {
        $this->validate();
        $quote = $this->isTemplate ? new TemplateCotizacion() : new Cotizacion();
        $quote->name = $this->name;
        $quote->fecha_emision = $this->fechaEmision;
        $quote->fecha_vencimiento = $this->fechaVencimiento;
        $quote->observaciones = $this->observaciones;
        if (!$this->isTemplate) {
            $quote->proyecto_id = $this->id;
            $quote->estado_cotizacion_id = $this->status;
        }

        if ($quote->save()) {
            $this->globalDispatchSweetAlert(action: 'session');
            if ($this->isTemplate) {
                return redirect()->route('quote-template', ['quote_template_id' => $quote->id]);
            }
            return redirect()->route('view-project-quote', ['id' => $this->id, 'quote_id' => $quote->id]);
        }
    }

    public function updateQuote()
    {
        try {
            $this->validate();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        if ($this->quoteInfo) {
            $this->quoteInfo->name = $this->name;
            $this->quoteInfo->fecha_emision = $this->fechaEmision;
            $this->quoteInfo->fecha_vencimiento = $this->fechaVencimiento;
            $this->quoteInfo->fecha_modificacion = now();
            $this->quoteInfo->observaciones = $this->observaciones;
            if (!$this->isTemplate) {
                $this->quoteInfo->estado_cotizacion_id = $this->status;
            }
            $this->quoteInfo->subTotal = floatval($this->subtotalQuote ?? 0);
            $this->quoteInfo->descuento = floatval($this->discountQuote ?? 0);
            $this->quoteInfo->total = floatval($this->totalQuote ?? 0);
            $this->quoteInfo->tax = floatval($this->tax ?? 0);
            $this->quoteInfo->save();

            if ($this->isTemplate) {
                TemplateCotizacionItem::where([
                    'template_cotizacion_id' => $this->quoteTemplateId
                ])->delete();
            } else {
                CotizacionItem::where(['cotizacion_id' => $this->quoteId])->delete();
            }

            if ($this->items) {
                foreach ($this->items as $item) {
                    $newQuote = $this->isTemplate ? new TemplateCotizacionItem() : new CotizacionItem();
                    $newQuote->cantidad = intval($item['quantity'] ?? 0);
                    $newQuote->precio = floatval($item['price'] ?? 0);
                    $newQuote->descuento = floatval($item['discount'] ?? 0);
                    $newQuote->fecha_creacion = now();
                    $newQuote->fecha_modificaion = now();
                    if ($this->isTemplate) {
                        $newQuote->template_cotizacion_id = $this->quoteTemplateId;
                    } else {
                        $newQuote->cotizacion_id = $item['quote_id'];
                    }
                    $newQuote->producto_id = $item['product_id'];
                    $newQuote->sub_total = $item['sub_total'];
                    $newQuote->tax = $item['tax'];
                    $newQuote->total = $item['total'];
                    $newQuote->save();
                }
            }

            $this->globalDispatchSweetAlert(action: 'session');

            if ($this->isTemplate) {
                return redirect()->route('quote-template', ['quote_template_id' => $this->quoteTemplateId]);
            }
            return redirect()->route('view-project-quote', ['id' => $this->id, 'quote_id' => $this->quoteId]);
        }
    }

    public function updating($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property

    }

    public function addItem()
    {
        $this->items[] = $this->newItem;
    }

    public function removeItem($keyItem)
    {
        if (array_key_exists($keyItem, $this->items)) {
            unset($this->items[$keyItem]);
            $this->calculatePrice();
        }
    }

    public function itemSelectPriceChange($itemKey)
    {
        $itemId = $this->items[$itemKey]['product_id'];
        $findProduct = array_filter($this->products, function ($product) use ($itemId) {
            return $product['id'] == $itemId;
        });

        if ($findProduct) {
            $findProduct = reset($findProduct);
            $this->items[$itemKey]['price'] = $findProduct['precio_venta'];
            $this->calculatePrice($itemKey);
        }
    }

    public function findProductsByProviderChange($itemKey)
    {
        $itemId = $this->items[$itemKey]['provider_id'];
        $this->items[$itemKey]['products'] = $this->getProductsByProvider($itemId);
        $this->items[$itemKey]['product_id'] = null;
    }

    public function getProductsByProvider($providerId)
    {
        return Producto::where([
            'proveedor_id' => $providerId
        ])->get()->toArray();
    }

    public function calculatePrice($itemKey = null)
    {
        if (!is_null($itemKey)) {
            $this->items[$itemKey]['sub_total'] = round((intval($this->items[$itemKey]['quantity'] ?? 0) * floatval($this->items[$itemKey]['price'] ?? 0)) - floatval($this->items[$itemKey]['discount'] ?? 0), 2);
            $this->items[$itemKey]['tax'] = $this->items[$itemKey]['tax_boolean'] ? round(($this->items[$itemKey]['sub_total'] * Proyecto::SALES_TAXES / 100), 2) : 0;
            $this->items[$itemKey]['total'] = round($this->items[$itemKey]['sub_total'] + $this->items[$itemKey]['tax'], 2);
        }

        $this->subTotal = round(array_sum(array_column($this->items, 'sub_total')), 2);
        $this->tax = round(array_sum(array_column($this->items, 'tax')), 2);
        $this->total = round(array_sum(array_column($this->items, 'total')), 2);
        $this->calculateTotalQuote();
    }

    public function calculateTotalQuote()
    {
        $this->subtotalQuote = $this->total;
        $this->totalQuote = floatval($this->subtotalQuote ?? 0) - floatval($this->discountQuote ?? 0);
    }

    public function addTax($itemKey)
    {
        $this->calculatePrice($itemKey);
    }

    public static function generateLinkShare($quoteId, $client = false): string
    {
        $quote = Cotizacion::where([
            'id' => $quoteId
        ])->first();
        $route = route('show-quote', ['uuid' => $quote->uuid]);
        if ($client){
            // buscar el ultimo cliente_estado_cotizacion uuid
            $uuidClient = ClienteEstadoCotizacion::where(['cotizacion_id' => $quote->id])->orderBy('id', 'desc')->first();
            if (!$uuidClient) {
                return '';
            }
            $route = route('show-quote-client', ['uuid' => $quote->uuid, 'sent_uuid' => $uuidClient->uuid]);
        }
        return $route;
    }

    public function showQuote($uuid, $sent_uuid = null)
    {
        $template = 'livewire.project.show-quote';
        $quoteId = Cotizacion::where(['uuid' => $uuid])->first();

        if (!$quoteId) {
            abort(404);
        }

        $clientStatusQuote = null;
        if ($sent_uuid) {
            $clientStatusQuote = ClienteEstadoCotizacion::where(['uuid' => $sent_uuid])->first();;
            if (!$clientStatusQuote) {
                abort(404);
            }
            $template = 'livewire.project.show-quote-client';
        }

        $quote = Cotizacion::findOrFail($quoteId->id);
        $quote->load('cotizacion_items', 'cotizacion_items.producto', 'cotizacion_items.producto.proveedor', 'proyecto', 'proyecto.usuario_cliente', 'usuario', 'estado_cotizacion');

        View::share('showHeader', false);
        View::share('showSidebar', false);
        View::share('containerLayout', 'container');

        return view($template, [
            'quote' => $quote,
            'clientStatusQuote' => $clientStatusQuote
        ]);
    }

    public function saveResponseClient(Request $request)
    {
        $quote = Cotizacion::where(['uuid' => request()->route()->parameter('uuid')])->first();
        $statusClientQuote = ClienteEstadoCotizacion::where(['uuid' => request()->route()->parameter('sent_uuid')])->first();
        $comment = request()->get('user-quote-message');
        $signature = request()->get('user-quote-signature');
        $statusResponseClient = request()->integer('answer-user');

        $statusAllowed = EstadoCotizacion::STATUS;
        unset($statusAllowed[EstadoCotizacion::DRAFT]);
        unset($statusAllowed[EstadoCotizacion::SENT]);

        if (!array_key_exists($statusResponseClient, $statusAllowed) || !$quote || !$statusClientQuote || (!$signature && $statusResponseClient == EstadoCotizacion::ACCEPTED)) {
            abort(404);
        }
        $quote->load('proyecto', 'proyecto.usuario_cliente');
        $quote->estado_cotizacion_id = $statusResponseClient;
        $quote->save();
        if ($statusResponseClient == EstadoCotizacion::ACCEPTED) {
            $invoice = new Factura();
            $invoice->titulo = $quote->name;
            $invoice->codigo_factura = $invoice->generarCodigoFactura();
            $invoice->fecha_emision = date('Y-m-d');
            $invoice->fecha_vencimiento = date('Y-m-d', strtotime($invoice->fecha_emision . '+ 31 days'));
            $invoice->subtotal = $quote->subtotal;
            $invoice->descuento = $quote->descuento;
            $invoice->total = $quote->total;
            $invoice->observaciones = $quote->observaciones;
            $invoice->fecha_creacion = now();
            $invoice->fecha_modificacion = now();
            $invoice->proyecto_id = $quote->proyecto_id;
            $invoice->cotizacion_id = $quote->id;
            $invoice->usuario_id = $quote->usuario_id;
            $invoice->usuario_cliente_id = $quote->proyecto->usuario_cliente_id;
            $invoice->estado_factura_id = 1;
            $invoice->save();

            // update project
            if ($quote->proyecto) {
                $quote->proyecto->proyecto_estado_id = ProyectoEstado::IN_PROCESS;
                $quote->proyecto->save();
            }
        }

        $statusClientQuote->estado_cotizacion = $statusResponseClient;
        $statusClientQuote->firma = $signature;
        $statusClientQuote->comentario = $comment;
        $statusClientQuote->save();

        // send constancy client
        Mail::to($quote->proyecto->usuario_cliente->email)->send(new QuoteNotifyClientConstancy($quote));
        // send constancy administrator
        $usersAdministrator = Usuario::where(['estado_id' => Estado::ACTIVE, 'rol_id' => Rol::ADMINISTRATOR])->get();
        if ($usersAdministrator) {
            foreach ($usersAdministrator as $user) {
                Mail::to($user->email)->send(new QuoteNotifyAdministratorFromClientDecision($quote, $statusClientQuote, $user));
            }
        }

        $this->globalDispatchSweetAlert(action: 'session');
        return redirect()->route('show-quote-client', ['uuid' => $quote->uuid, 'sent_uuid' => $statusClientQuote->uuid]);
    }

    public static function matchStatus(int $id, int $status = EstadoCotizacion::DRAFT): bool
    {
        return Cotizacion::where('id', $id)->first()->estado_cotizacion_id == $status;
    }

    public static function isTemplate(int $quoteId)
    {
        return Cotizacion::where('id', $quoteId)->first()->is_template;
    }

    public function saveQuoteTemplateInProject(Request $request)
    {
        $projectId = $request->route()->parameter('project_id', 0);
        $quoteId = $request->get('quote-id');
        $project = Proyecto::findOrFail($projectId);

        if ($quoteId && is_array($quoteId)) {
            foreach ($quoteId as $item) {
                $quoteTemplate = TemplateCotizacion::findOrFail($item);
                $quoteTemplate->load('cotizacion_items_template');

                $quoteInfo = new Cotizacion();
                $quoteInfo->name = $quoteTemplate->name;
                $quoteInfo->subtotal = $quoteTemplate->subtotal;
                $quoteInfo->descuento = $quoteTemplate->descuento;
                $quoteInfo->total = $quoteTemplate->total;
                $quoteInfo->tax = $quoteTemplate->tax;
                $quoteInfo->observaciones = $quoteTemplate->observaciones;
                $quoteInfo->estado_cotizacion_id = EstadoCotizacion::DRAFT;
                $quoteInfo->fecha_emision = date('Y-m-d');
                $quoteInfo->fecha_vencimiento = date('Y-m-d', strtotime($quoteInfo->fecha_creacion . '+ 5 days'));
                $quoteInfo->proyecto_id = $project->id;
                $quoteInfo->is_template = false;
                $quoteInfo->fecha_creacion = now();
                $quoteInfo->fecha_modificacion = now();
                $quoteInfo->save();

                foreach ($quoteTemplate->cotizacion_items_template as $item) {
                    unset($item->id);
                    unset($item->fecha_creacion);
                    unset($item->fecha_modificaion);
                    unset($item->template_cotizacion_id);
                    $item->cotizacion_id = $quoteInfo->id;
                    $item->fecha_creacion = now();
                    $item->fecha_modificaion = now();
                    CotizacionItem::create($item->toArray());
                }
            }

            $this->globalDispatchSweetAlert(action: 'session');
        }

        return redirect()->route('view-project', ['id' => $project->id]);
    }

    public function sendQuote($quoteId)
    {
        try {
            $quote = Cotizacion::findOrFail($quoteId);
            // update status quote
            $quote->estado_cotizacion_id = EstadoCotizacion::SENT;
            $quote->save();
            // update project status sent
            $project = Proyecto::findOrFail($quote->proyecto_id);
            $project->proyecto_estado_id = ProyectoEstado::SENT;
            $project->save();
            $quote->load('proyecto', 'proyecto.usuario_cliente');
            $clientStatusQuote = ClienteEstadoCotizacion::create(['cotizacion_id' => $quote->id, 'titulo' => '']);
            Mail::to($quote->proyecto->usuario_cliente->email)->send(new QuoteNotifyClient($quote, $clientStatusQuote));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('view-project', ['id' => $quote->proyecto_id]);
    }


    public function render()
    {
        return view('livewire.agregar-cotizacion');
    }
}

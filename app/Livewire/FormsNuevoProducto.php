<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\Estado;
use App\Models\EstadoProducto;
use App\Models\Producto;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class FormsNuevoProducto extends Component
{
    use GlobalMessage;
    public $nombre;
    public $descripcion;
    public $unidadMedida;
    public $precioCompra;
    public $precioVenta;
    public $agreadoPor;
    public $estado;
    public $data;
    public $proveedor;
    public $tipoMedida;

    public function render()
    {
        $this->data = EstadoProducto::All();
        return view('livewire.forms-nuevo-producto');
    }

    public function rules()
    {
        return [
            'nombre' => 'required',
            'unidadMedida' => 'required',
            'tipoMedida' => 'required',
            'precioCompra' => 'required|numeric|min:0.01',
            'precioVenta' => 'required|numeric|min:0.01',
            'proveedor' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => __('lang.this_field_is_required'),
            'tipoMedida.required' => __('lang.this_field_is_required'),
            'unidadMedida.required' => __('lang.this_field_is_required'),
            'precioCompra.required' => __('lang.this_field_is_required'),
            'precioVenta.required' => __('lang.this_field_is_required'),
            'proveedor.required' => __('lang.this_field_is_required'),
        ];
    }

    public function validationAttributes()
    {
        return [
            'precioCompra' => '',
            'precioVenta' => '',
        ];
    }

    public function guardar()
    {
        if (auth()->user()->isClient()) {
            $this->globalDispatchSweetAlert(__('lang.error_message.not_allowed'), __('lang.error_message.not_allowed_message'), 'error');
            $this->globalDispatchModal('modal-new-product');
            $this->reset(['nombre', 'descripcion', 'unidadMedida', 'precioCompra', 'precioVenta', 'agreadoPor', 'estado']);
            return;
        }
        $this->validate();
        $this->agreadoPor = auth()->user()->id;
        $producto = new Producto();
        $producto->nombre = $this->nombre;
        $producto->descripcion = $this->descripcion;
        $producto->tipo_medida_id = $this->tipoMedida;
        $producto->unidad_medida = $this->unidadMedida;
        $producto->precio_compra = $this->precioCompra;
        $producto->precio_venta = $this->precioVenta;
        $producto->usuario_id = $this->agreadoPor;
        $producto->estado_producto_id = 1;
        $producto->proveedor_id = $this->proveedor;
        $producto->fecha_creacion = now();
        $producto->fecha_modificacion = now();
        $save = $producto->save();
        if ($save) {
            $this->dispatch('refreshDatatable');
            $this->reset(['nombre', 'descripcion', 'unidadMedida', 'precioCompra', 'precioVenta', 'agreadoPor', 'estado']);
            $this->globalDispatchModal('modal-new-product');
            $this->globalDispatchSweetAlert();
        };
    }

    public function uploadFile(Request $request)
    {
        request()->validate([
            'file-excel' => 'required|mimes:xlsx,xls',
        ]);

        $fileExcel = request()->file('file-excel');
        Excel::import(new ProductImport(), $fileExcel);

        return response()->json([
            'success' => true,
        ]);
    }

}

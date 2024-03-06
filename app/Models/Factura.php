<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Factura
 *
 * @property int $id
 * @property string $titulo
 * @property string|null $codigo_factura
 * @property Carbon $fecha_emision
 * @property Carbon $fecha_vencimiento
 * @property float $subtotal
 * @property float|null $descuento
 * @property float $total
 * @property int|null $es_proyecto
 * @property string|null $observaciones
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property int $usuario_id
 * @property int $usuario_cliente_id
 * @property int $proyecto_id
 * @property int $cotizacion_id
 * @property int $estado_factura_id
 *
 * @property Usuario $usuario
 * @property UsuarioCliente $usuario_cliente
 * @property Proyecto $proyecto
 * @property Cotizacion $cotizacion
 * @property EstadoFactura $estado_factura
 * @property Collection|FacturaItem[] $factura_items
 *
 * @package App\Models
 */
class Factura extends Model
{
	protected $table = 'factura';
	public $timestamps = false;

	protected $casts = [
		'subtotal' => 'float',
		'descuento' => 'float',
		'total' => 'float',
		'es_proyecto' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'usuario_id' => 'int',
		'usuario_cliente_id' => 'int',
		'proyecto_id' => 'int',
		'cotizacion_id' => 'int',
		'estado_factura_id' => 'int'
	];

	protected $fillable = [
		'titulo',
		'codigo_factura',
		'fecha_emision',
		'fecha_vencimiento',
		'subtotal',
		'descuento',
		'total',
		'es_proyecto',
		'observaciones',
		'fecha_creacion',
		'fecha_modificacion',
		'usuario_id',
		'usuario_cliente_id',
		'proyecto_id',
		'cotizacion_id',
		'estado_factura_id',
	];

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function usuario_cliente()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class);
	}

	public function estado_factura()
	{
		return $this->belongsTo(EstadoFactura::class);
	}

	public function factura_items()
	{
		return $this->hasMany(FacturaItem::class);
	}

    public function generarCodigoFactura()
    {
        $ultimaFactura = Factura::orderBy('id', 'desc')->first();
        $numeroFactura = $ultimaFactura ? substr($ultimaFactura->codigo_factura, 4) + 1 : 1;
        $numeroFormateado = str_pad($numeroFactura, 5, '0', STR_PAD_LEFT);
        $prefijo = 'INV';
        return "{$prefijo}-{$numeroFormateado}";
    }
}

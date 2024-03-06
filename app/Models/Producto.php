<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $unidad_medida
 * @property float|null $precio_compra
 * @property float $precio_venta
 * @property int $usuario_id
 * @property int $estado_producto_id
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property int|null $proveedor_id
 * @property int|null $tipo_medida_id
 *
 * @property EstadoProducto $estado_producto
 * @property Proveedor|null $proveedor
 * @property Usuario $usuario
 * @property Collection|CotizacionItem[] $cotizacion_items
 * @property Collection|FacturaItem[] $factura_items
 * @property Collection|ProyectoCotizacion[] $proyecto_cotizacions
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'producto';
	public $timestamps = false;

	protected $casts = [
		'precio_compra' => 'float',
		'precio_venta' => 'float',
		'usuario_id' => 'int',
		'estado_producto_id' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'proveedor_id' => 'int',
		'tipo_medida_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'unidad_medida',
		'precio_compra',
		'precio_venta',
		'usuario_id',
		'estado_producto_id',
		'fecha_creacion',
		'fecha_modificacion',
		'proveedor_id',
		'tipo_medida_id'
	];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->usuario_id = auth()->user()->id;
            $model->fecha_creacion = now();
            $model->fecha_modificacion = now();
            $model->estado_producto_id = EstadoProducto::STOCK;
        });
    }

	public function estado_producto()
	{
		return $this->belongsTo(EstadoProducto::class);
	}

	public function proveedor()
	{
		return $this->belongsTo(Proveedor::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function cotizacion_items()
	{
		return $this->hasMany(CotizacionItem::class);
	}

	public function factura_items()
	{
		return $this->hasMany(FacturaItem::class);
	}

	public function proyecto_cotizacions()
	{
		return $this->hasMany(ProyectoCotizacion::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CotizacionItem
 *
 * @property int $id
 * @property int $cantidad
 * @property float $precio
 * @property float|null $descuento
 * @property float $sub_total
 * @property float $total
 * @property float $tax
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificaion
 * @property int $cotizacion_id
 * @property int $producto_id
 *
 * @property Cotizacion $cotizacion
 * @property Producto $producto
 *
 * @package App\Models
 */
class CotizacionItem extends Model
{
	protected $table = 'cotizacion_item';
	public $timestamps = false;

	protected $casts = [
		'cantidad' => 'int',
		'precio' => 'float',
		'descuento' => 'float',
		'sub_total' => 'float',
		'total' => 'float',
		'tax' => 'float',
		'fecha_creacion' => 'datetime',
		'fecha_modificaion' => 'datetime',
		'cotizacion_id' => 'int',
		'producto_id' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'precio',
		'descuento',
		'sub_total',
		'total',
		'tax',
		'fecha_creacion',
		'fecha_modificaion',
		'cotizacion_id',
		'producto_id'
	];

	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class);
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}
}

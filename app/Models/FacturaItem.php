<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacturaItem
 * 
 * @property int $id
 * @property float $cantidad
 * @property float $precio
 * @property float|null $descuento
 * @property int $factura_id
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property int $producto_id
 * 
 * @property Factura $factura
 * @property Producto $producto
 *
 * @package App\Models
 */
class FacturaItem extends Model
{
	protected $table = 'factura_items';
	public $timestamps = false;

	protected $casts = [
		'cantidad' => 'float',
		'precio' => 'float',
		'descuento' => 'float',
		'factura_id' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'producto_id' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'precio',
		'descuento',
		'factura_id',
		'fecha_creacion',
		'fecha_modificacion',
		'producto_id'
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateCotizacionItem
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
 * @property int $template_cotizacion_id
 * @property int $producto_id
 * 
 * @property TemplateCotizacion $template_cotizacion
 * @property Producto $producto
 *
 * @package App\Models
 */
class TemplateCotizacionItem extends Model
{
	protected $table = 'template_cotizacion_item';
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
		'template_cotizacion_id' => 'int',
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
		'template_cotizacion_id',
		'producto_id'
	];

	public function template_cotizacion()
	{
		return $this->belongsTo(TemplateCotizacion::class);
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}
}

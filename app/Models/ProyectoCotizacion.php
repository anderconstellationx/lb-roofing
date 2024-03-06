<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoCotizacion
 * 
 * @property int $id
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property int $producto_id
 * @property int $proyecto_id
 * @property int $usuario_id
 * 
 * @property Producto $producto
 * @property Proyecto $proyecto
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class ProyectoCotizacion extends Model
{
	protected $table = 'proyecto_cotizacion';
	public $timestamps = false;

	protected $casts = [
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'producto_id' => 'int',
		'proyecto_id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'fecha_creacion',
		'fecha_modificacion',
		'producto_id',
		'proyecto_id',
		'usuario_id'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}

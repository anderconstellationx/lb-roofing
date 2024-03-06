<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDireccion
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 *
 * @package App\Models
 */
class TipoDireccion extends Model
{
	protected $table = 'tipo_direccion';
	public $timestamps = false;

	protected $casts = [
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'fecha_creacion',
		'fecha_modificacion'
	];
}

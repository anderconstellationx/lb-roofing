<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Direccion
 * 
 * @property int $id
 * @property string $direccion
 * @property int $tipo_direccion
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Direccion extends Model
{
	protected $table = 'direccion';
	public $timestamps = false;

	protected $casts = [
		'tipo_direccion' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'direccion',
		'tipo_direccion',
		'fecha_creacion',
		'fecha_modificacion',
		'usuario_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}

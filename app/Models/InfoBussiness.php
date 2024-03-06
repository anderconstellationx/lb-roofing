<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InfoBussiness
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $nombre_mostrar
 * @property string $direccion
 * @property string $telefono
 * @property string $correo
 * @property string|null $rlegal_nombres
 * @property string|null $rlegal_apellidos
 * @property string|null $rlegal_correo
 * @property string|null $rlegal_telefono
 * @property string|null $sitio_web
 * @property string|null $info
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $moneda
 *
 * @package App\Models
 */
class InfoBussiness extends Model
{
	protected $table = 'info_bussiness';

	protected $fillable = [
		'nombre',
		'nombre_mostrar',
		'direccion',
		'telefono',
		'correo',
		'rlegal_nombres',
		'rlegal_apellidos',
		'rlegal_correo',
		'rlegal_telefono',
		'sitio_web',
		'info',
		'logo',
		'moneda'
	];
}

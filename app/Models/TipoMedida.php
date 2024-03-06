<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMedida
 * 
 * @property int $id
 * @property string $medida
 * @property string $sufijo
 * @property string $slug
 *
 * @package App\Models
 */
class TipoMedida extends Model
{
	protected $table = 'tipo_medida';
	public $timestamps = false;

	protected $fillable = [
		'medida',
		'sufijo',
		'slug'
	];
}

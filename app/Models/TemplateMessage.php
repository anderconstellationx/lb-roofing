<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateMessage
 *
 * @property int $id
 * @property string $name
 * @property string $message
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @package App\Models
 */
class TemplateMessage extends Model
{
	protected $table = 'template_message';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'message',
        'fecha_creacion',
        'fecha_modificacion'
	];
}

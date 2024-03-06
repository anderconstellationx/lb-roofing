<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Casts\PurifyHtmlOnSet;

/**
 * Class Interaccion
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $galeria_proyecto_id
 * @property string $comentario
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 *
 * @property Usuario $usuario
 * @property GaleriaProyecto $galeria_proyecto
 *
 * @package App\Models
 */
class Interaccion extends Model
{
	protected $table = 'interaccion';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'galeria_proyecto_id' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
        'comentario' => PurifyHtmlOnSet::class
	];

	protected $fillable = [
		'usuario_id',
		'galeria_proyecto_id',
		'comentario',
		'fecha_creacion',
		'fecha_modificacion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function galeria_proyecto()
	{
		return $this->belongsTo(GaleriaProyecto::class);
	}

    public function getDateComment(): string
    {
        return Carbon::parse($this->fecha_creacion)->toDateTimeString();
    }
}

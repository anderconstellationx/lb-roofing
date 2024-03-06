<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GaleriaItem
 *
 * @property int $id
 * @property int $galeria_id
 * @property bool $visible
 * @property string $nombre
 * @property string $path
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property string $type
 *
 * @package App\Models
 */
class GaleriaItem extends Model
{
    const Visible = 1;
    const NoVisible = 0;

	protected $table = 'galeria_item';
	public $timestamps = false;

	protected $casts = [
		'galeria_id' => 'int',
		'visible' => 'bool',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime'
	];

	protected $fillable = [
		'galeria_id',
		'visible',
		'nombre',
		'path',
		'fecha_creacion',
		'fecha_modificacion',
		'type'
	];

    public function galeria()
    {
        return $this->belongsTo(GaleriaProyecto::class, 'galeria_id');
    }
}

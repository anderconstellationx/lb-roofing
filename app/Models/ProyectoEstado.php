<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * @property string|null $descripcion
 * @property string|null $color
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 *
 * @property Collection|Proyecto[] $proyectos
 *
 * @package App\Models
 */
class ProyectoEstado extends Model
{
    const QUOTING = 1;
    const SENT = 2;
    const IN_PROCESS = 3;
    const PAUSED = 4;
    const FINISHED = 5;
    const CANCELED = 6;

    protected $table = 'proyecto_estado';
    public $timestamps = false;

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'fecha_modificacion' => 'datetime'
    ];

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'color',
        'fecha_creacion',
        'fecha_modificacion'
    ];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
}

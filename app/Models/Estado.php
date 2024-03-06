<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 *
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * @property string|null $descripcion
 *
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Estado extends Model
{
	protected $table = 'estado';
	public $timestamps = false;

	protected $casts = [];

	protected $fillable = [
		'nombre',
		'slug',
		'descripcion',
	];

    const ACTIVE = 1;
    const INACTIVE = 2;
}

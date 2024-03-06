<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoProducto
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $slug
 * @property int $usuario_id
 *
 * @property Usuario $usuario
 * @property Collection|Producto[] $productos
 *
 * @package App\Models
 */
class EstadoProducto extends Model
{
	protected $table = 'estado_producto';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'slug',
		'usuario_id'
	];

    const STOCK = 1;

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function productos()
	{
		return $this->hasMany(Producto::class);
	}
}

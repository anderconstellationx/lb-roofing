<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoCliente
 * 
 * @property int $id
 * @property string $tipo
 * @property string $slug
 * 
 * @property Collection|UsuarioCliente[] $usuario_clientes
 *
 * @package App\Models
 */
class TipoCliente extends Model
{
	protected $table = 'tipo_cliente';
	public $timestamps = false;

	protected $fillable = [
		'tipo',
		'slug'
	];

	public function usuario_clientes()
	{
		return $this->hasMany(UsuarioCliente::class);
	}
}

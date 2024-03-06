<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioCliente
 * 
 * @property int $id
 * @property int $usuario_id
 * @property int $tipo_cliente_id
 * 
 * @property TipoCliente $tipo_cliente
 * @property Usuario $usuario
 * @property Collection|Factura[] $facturas
 * @property Collection|Proyecto[] $proyectos
 *
 * @package App\Models
 */
class UsuarioCliente extends Model
{
	protected $table = 'usuario_cliente';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'tipo_cliente_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'tipo_cliente_id'
	];

	public function tipo_cliente()
	{
		return $this->belongsTo(TipoCliente::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}

	public function proyectos()
	{
		return $this->hasMany(Proyecto::class);
	}
}

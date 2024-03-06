<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoFactura
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Collection|Factura[] $facturas
 *
 * @package App\Models
 */
class EstadoFactura extends Model
{
	protected $table = 'estado_factura';
	public $timestamps = false;
    const DRAFT = 1;
    const DUE = 2;
    const PAID = 3;

	protected $fillable = [
		'nombre'
	];

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}
}

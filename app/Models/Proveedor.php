<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedor
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $marca
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Producto[] $productos
 *
 * @package App\Models
 */
class Proveedor extends Model
{
	protected $table = 'proveedor';

	protected $fillable = [
		'nombre',
		'marca'
	];

	public function productos()
	{
		return $this->hasMany(Producto::class);
	}
}

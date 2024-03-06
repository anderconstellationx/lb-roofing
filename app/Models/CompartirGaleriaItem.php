<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompartirGaleriaItem
 *
 * @property int $id
 * @property int $compartir_galeria_id
 * @property int $galeria_proyecto_id
 *
 * @property CompartirGaleria $compartir_galerium
 * @property GaleriaProyecto $galeria_proyecto
 *
 * @package App\Models
 */
class CompartirGaleriaItem extends Model
{
	protected $table = 'compartir_galeria_items';
	public $timestamps = false;

	protected $casts = [
		'compartir_galeria_id' => 'int',
		'galeria_proyecto_id' => 'int'
	];

	protected $fillable = [
		'compartir_galeria_id',
		'galeria_proyecto_id'
	];

	public function compartir_galerium()
	{
		return $this->belongsTo(CompartirGaleria::class, 'compartir_galeria_id');
	}

	public function galeria_proyecto()
	{
		return $this->belongsTo(GaleriaProyecto::class);
	}
}

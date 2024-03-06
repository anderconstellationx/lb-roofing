<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GalleryReportItem
 * 
 * @property int $id
 * @property int $gallery_report_id
 * @property int $galeria_proyecto_id
 * 
 * @property GalleryReport $gallery_report
 * @property GaleriaProyecto $galeria_proyecto
 *
 * @package App\Models
 */
class GalleryReportItem extends Model
{
	protected $table = 'gallery_report_items';
	public $timestamps = false;

	protected $casts = [
		'gallery_report_id' => 'int',
		'galeria_proyecto_id' => 'int'
	];

	protected $fillable = [
		'gallery_report_id',
		'galeria_proyecto_id'
	];

	public function gallery_report()
	{
		return $this->belongsTo(GalleryReport::class);
	}

	public function galeria_proyecto()
	{
		return $this->belongsTo(GaleriaProyecto::class);
	}
}

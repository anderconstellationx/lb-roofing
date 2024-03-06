<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class GalleryReport
 *
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string|null $file
 * @property int $proyecto_id
 * @property int $usuario_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Usuario $usuario
 * @property Proyecto $proyecto
 * @property Collection|GalleryReportItem[] $gallery_report_items
 *
 * @package App\Models
 */
class GalleryReport extends Model
{
	protected $table = 'gallery_report';

	protected $casts = [
		'proyecto_id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'title',
        'file',
        'proyecto_id',
        'usuario_id'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
            $model->usuario_id = auth()->user()->id;
            $model->created_at = Carbon::now();
            $model->updated_at = Carbon::now();
        });
    }

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function gallery_report_items()
	{
		return $this->hasMany(GalleryReportItem::class);
	}
}

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
 * Class CompartirGaleria
 *
 * @property int $id
 * @property string $link
 * @property int $proyecto_id
 * @property int $usuario_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Usuario $usuario
 * @property Proyecto $proyecto
 * @property Collection|CompartirGaleriaItem[] $compartir_galeria_items
 *
 * @package App\Models
 */
class CompartirGaleria extends Model
{
	protected $table = 'compartir_galeria';

	protected $casts = [
		'proyecto_id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'link',
		'proyecto_id',
		'usuario_id'
	];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->link = Str::random(10);
            $model->usuario_id = auth()->user()->id;
            $model->created_at = now();
            $model->updated_at = now();
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

	public function compartir_galeria_items()
	{
		return $this->hasMany(CompartirGaleriaItem::class, 'compartir_galeria_id');
	}
}

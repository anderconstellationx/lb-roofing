<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class TemplateCotizacion
 *
 * @property int $id
 * @property string $name
 * @property Carbon $fecha_emision
 * @property Carbon $fecha_vencimiento
 * @property float $subtotal
 * @property float $descuento
 * @property float $total
 * @property float $tax
 * @property string|null $observaciones
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property bool $estado
 * @property int $usuario_id
 *
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class TemplateCotizacion extends Model
{
	protected $table = 'template_cotizacion';
	public $timestamps = false;

	protected $casts = [
		'fecha_emision' => 'datetime',
		'fecha_vencimiento' => 'datetime',
		'subtotal' => 'float',
		'descuento' => 'float',
		'total' => 'float',
		'tax' => 'float',
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'estado' => 'bool',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'name',
		'fecha_emision',
		'fecha_vencimiento',
		'subtotal',
		'descuento',
		'total',
		'tax',
		'observaciones',
		'fecha_creacion',
		'fecha_modificacion',
		'estado',
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
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->usuario_id = auth()->user()->id;
        });
    }

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

    public function cotizacion_items_template()
    {
        return $this->hasMany(TemplateCotizacionItem::class);
    }

    public static function getQuoteAsTemplate(): array
    {
        return TemplateCotizacion::where([
            'estado' => true
        ])->get()->toArray();
    }
}

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
 * Class Cotizacion
 *
 * @property int $id
 * @property string $uuid
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
 * @property int $proyecto_id
 * @property int $usuario_id
 * @property int $estado_cotizacion_id
 * @property bool $is_template
 *
 * @property Proyecto $proyecto
 * @property Usuario $usuario
 * @property EstadoCotizacion $estado_cotizacion
 * @property Collection|CotizacionItem[] $cotizacion_items
 * @property Collection|Factura[] $facturas
 *
 * @package App\Models
 */
class Cotizacion extends Model
{
	protected $table = 'cotizacion';
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
		'proyecto_id' => 'int',
		'usuario_id' => 'int',
		'estado_cotizacion_id' => 'int',
		'is_template' => 'bool'
	];

	protected $fillable = [
		'uuid',
		'uuid_client',
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
		'proyecto_id',
		'usuario_id',
		'estado_cotizacion_id',
		'is_template'
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
            $model->name = ucwords(strtolower($model->name));
            $model->uuid = Str::uuid()->toString();
            $model->uuid_client = Str::uuid()->toString();
            $model->usuario_id = auth()->user()->id;
        });
    }

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function estado_cotizacion()
	{
		return $this->belongsTo(EstadoCotizacion::class);
	}

	public function cotizacion_items()
	{
		return $this->hasMany(CotizacionItem::class);
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}
}

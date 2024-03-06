<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class ClienteEstadoCotizacion
 *
 * @property int $id
 * @property string $uuid
 * @property string $titulo
 * @property int $cotizacion_id
 * @property string|null $firma
 * @property string|null $comentario
 * @property string|null $mensaje_cliente
 * @property int $estado_cotizacion
 * @property int $usuario_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Cotizacion $cotizacion
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class ClienteEstadoCotizacion extends Model
{
	protected $table = 'cliente_estado_cotizacion';

	protected $casts = [
		'cotizacion_id' => 'int',
		'estado_cotizacion' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'titulo',
		'cotizacion_id',
		'firma',
		'comentario',
		'mensaje_cliente',
		'estado_cotizacion',
		'usuario_id'
	];



    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
            $model->usuario_id = auth()->user()->id;
            $model->created_at = now();
            $model->updated_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}

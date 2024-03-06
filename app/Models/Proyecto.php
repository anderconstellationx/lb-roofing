<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 *
 * @property int $id
 * @property string|null $titulo
 * @property string|null $enlace_galeria
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property string|null $direccion
 * @property string|null $observaciones
 * @property int $usuario_encargado_id
 * @property int $proyecto_estado_id
 * @property int $usuario_id
 * @property int $usuario_cliente_id
 * @property int $countries_id
 * @property int $state_id
 * @property int $cities_id
 *
 * @property ProyectoEstado $proyecto_estado
 * @property UsuarioCliente $usuario_cliente
 * @property Usuario $usuario
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|Factura[] $facturas
 * @property Collection|GaleriaProyecto[] $galeria_proyectos
 * @property Collection|ProyectoCotizacion[] $proyecto_cotizacions
 *
 * @package App\Models
 */
class Proyecto extends Model
{
	protected $table = 'proyecto';
	public $timestamps = false;

	protected $casts = [
		'fecha_creacion' => 'datetime',
		'fecha_modificacion' => 'datetime',
		'usuario_encargado_id' => 'int',
		'proyecto_estado_id' => 'int',
		'usuario_id' => 'int',
		'usuario_cliente_id' => 'int',
        'countries_id' => 'int',
        'state_id' => 'int',
        'cities_id' => 'int'
	];

	protected $fillable = [
		'titulo',
		'enlace_galeria',
		'fecha_inicio',
		'fecha_fin',
		'fecha_creacion',
		'fecha_modificacion',
		'direccion',
		'observaciones',
		'encargado_id',
		'proyecto_estado_id',
		'usuario_id',
		'usuario_cliente_id'
	];
    const SALES_TAXES = 8.25;
	public function proyecto_estado()
	{
		return $this->belongsTo(ProyectoEstado::class);
	}

	public function usuario_cliente()
	{
		return $this->belongsTo(Usuario::class, 'usuario_cliente_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'usuario_id');
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class);
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}

	public function galeria_proyectos()
	{
		return $this->hasMany(GaleriaProyecto::class);
	}

	public function proyecto_cotizacions()
	{
		return $this->hasMany(ProyectoCotizacion::class);
	}
    public function usuario_encargado()
    {
        return $this->belongsTo(Usuario::class, 'usuario_encargado_id');
    }
}

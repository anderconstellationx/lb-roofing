<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Usuario
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string $email
 * @property string $password
 * @property Carbon|null $nacimiento
 * @property string|null $documento
 * @property string|null $genero
 * @property Carbon $fecha_creacion
 * @property Carbon $fecha_modificacion
 * @property int $rol_id
 * @property int $estado_id
 *
 * @property Rol $rol
 * @property Estado $estado
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|Direccion[] $direccions
 * @property Collection|Estado[] $estados
 * @property Collection|EstadoProducto[] $estado_productos
 * @property Collection|Factura[] $facturas
 * @property Collection|GaleriaProyecto[] $galeria_proyectos
 * @property Collection|Interaccion[] $interaccions
 * @property Collection|Producto[] $productos
 * @property Collection|Proyecto[] $proyectos
 * @property Collection|ProyectoCotizacion[] $proyecto_cotizacions
 * @property Collection|UsuarioCliente[] $usuario_clientes
 *
 * @package App\Models
 */
class Usuario extends Authenticatable
{
    use  HasFactory, Notifiable;

    const ADMIN = 1;
    const EMPLOYEE = 2; // NOW IS SELLER
    const ACCOUNTANT = 3;
    const CLIENT = 4;

    protected $table = 'usuario';
    public $timestamps = false;

    protected $casts = [
        'nacimiento' => 'datetime',
        'fecha_creacion' => 'datetime',
        'fecha_modificacion' => 'datetime',
        'rol_id' => 'int',
        'estado_id' => 'int'
    ];

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'direccion',
        'email',
        'password',
        'nacimiento',
        'documento',
        'genero',
        'fecha_creacion',
        'fecha_modificacion',
        'rol_id',
        'estado_id'
    ];

    const GENDER_MASCULINE = 1;
    const GENDER_FEMALE = 2;

    const GENDER = [
        self::GENDER_MASCULINE => 'lang.masculine',
        self::GENDER_FEMALE => 'lang.female',
    ];

    public static function isAdmin(): bool
    {
        $user = auth()->user();
        if ($user) {
            return $user->rol_id == Rol::ADMINISTRATOR;
        }

        return false;
    }

    public static function accessAllowed(): bool
    {
        return static::isAdmin() || static::isSeller() || static::isAccountant();
    }

    public static function isSeller(): bool
    {
        $user = auth()->user();
        if ($user) {
            return $user->rol_id == self::EMPLOYEE;
        }
        return false;
    }

    public static function isAccountant(): bool
    {
        $user = auth()->user();
        if ($user) {
            return $user->rol_id == self::ACCOUNTANT;
        }
        return false;
    }

    public static function isClient(): bool
    {
        $user = auth()->user();
        if ($user) {
            return $user->rol_id == self::CLIENT;
        }
        return false;
    }

    public function getCompleteName(): string
    {
        return ucwords(strtolower("{$this->nombres} {$this->apellidos}"));
    }

    public static function getUserCountByRole(int $rol): int
    {
        return static::where('rol_id', $rol)->count();
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cotizacions()
    {
        return $this->hasMany(Cotizacion::class);
    }

    public function direccions()
    {
        return $this->hasMany(Direccion::class);
    }

    public function estados()
    {
        return $this->hasMany(Estado::class);
    }

    public function estado_productos()
    {
        return $this->hasMany(EstadoProducto::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function galeria_proyectos()
    {
        return $this->hasMany(GaleriaProyecto::class);
    }

    public function interaccions()
    {
        return $this->hasMany(Interaccion::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'agregado_por');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function proyecto_cotizacions()
    {
        return $this->hasMany(ProyectoCotizacion::class);
    }

    public function usuario_clientes()
    {
        return $this->hasMany(UsuarioCliente::class);
    }

    public static function getUsers()
    {
        return Usuario::where('estado_id', Estado::ACTIVE)->get();
    }
}

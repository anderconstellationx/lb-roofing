<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GaleriaProyecto
 *
 * @property int $id
 * @property string $nombre
 * @property string $nombre_original
 * @property string $path
 * @property Carbon $fecha_creacion
 * @property bool $visible
 * @property string $type
 * @property int $proyecto_id
 * @property int $usuario_id
 *
 * @property Proyecto $proyecto
 * @property Usuario $usuario
 * @property Collection|Interaccion[] $interaccions
 *
 * @package App\Models
 */
class GaleriaProyecto extends Model
{
	protected $table = 'galeria_proyecto';
	public $timestamps = false;

	protected $casts = [
		'fecha_creacion' => 'datetime',
		'visible' => 'bool',
		'proyecto_id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'nombre_original',
		'path',
		'fecha_creacion',
		'visible',
		'type',
		'proyecto_id',
		'usuario_id'
	];

    const MIME_TYPE_IMAGE_ALLOWED = [
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'svg' => 'image/svg+xml',
    ];

    const MIME_TYPE_VIDEO_ALLOWED = [
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
        'ogg' => 'video/ogg',
    ];

    const VISIBLE = 1;
    const HIDDEN = 0;

    /* bytes */
    const MAX_FILE_SIZE = 209715200; // 250MB
    const NAME_DISK_STORAGE = 'gallery_projects';

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function interaccions()
	{
		return $this->hasMany(Interaccion::class);
	}

    public static function getDisplayFilesize($numBytes = self::MAX_FILE_SIZE, $adjustPrecision = true, $units = ''): string
    {
        if ($numBytes == 0) {
            return '0 Bytes';
        }
        if ($numBytes == 1) {
            return '1 Byte';
        }

        $numBytes = abs($numBytes);
        if (strtolower($units) === 'iec_formal') {
            $magnitude = pow(2, 10);
            $abbreviations = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
        } elseif (strtolower($units) === 'si') {
            $magnitude = pow(10, 3);
            $abbreviations = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        } else {
            $magnitude = pow(2, 10);
            $abbreviations = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        }

        $pos = floor(log($numBytes, $magnitude));
        $result = ($numBytes / pow($magnitude, $pos));

        return ($pos == 0 || ($adjustPrecision && $result >= 99.995) ? number_format($result, 0) : number_format($result, 2)) . ' ' . $abbreviations[$pos];
    }

    public static function getMimeTypeAllowed(): array
    {
        return array_merge(self::MIME_TYPE_IMAGE_ALLOWED, self::MIME_TYPE_VIDEO_ALLOWED);
    }
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoCotizacion
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Collection|Cotizacion[] $cotizacions
 *
 * @package App\Models
 */
class EstadoCotizacion extends Model
{
	protected $table = 'estado_cotizacion';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

    const NONE = 0;
    const DRAFT = 1;
    const DRAFT_LANG = 'Draft';
    const SENT = 2;
    const SENT_LANG = 'Sent';
    const CANCELED = 3;
    const CANCELED_LANG = 'Canceled';
    const ACCEPTED = 4;
    const ACCEPTED_LANG = 'Accepted';
    const REVISION = 5;
    const REVISION_LANG = 'Revision';

    const STATUS = [
        self::DRAFT => self::DRAFT_LANG,
        self::SENT => self::SENT_LANG,
        self::CANCELED => self::CANCELED_LANG,
        self::ACCEPTED => self::ACCEPTED_LANG,
        self::REVISION => self::REVISION_LANG,
    ];

    const STATUS_SHOW_CLIENT = [
        self::CANCELED => 'lang.quote.rejection_sent',
        self::ACCEPTED => 'lang.quote.acceptance_sent',
        self::REVISION => 'lang.quote.revision_request_sent',
    ];

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class);
	}
}

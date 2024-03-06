<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $shortname
 * @property string $name
 * @property int $phonecode
 * 
 * @property Collection|State[] $states
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $casts = [
		'phonecode' => 'int'
	];

	protected $fillable = [
		'shortname',
		'name',
		'phonecode'
	];

	public function states()
	{
		return $this->hasMany(State::class, 'countries_id');
	}
}

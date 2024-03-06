<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $id
 * @property string $name
 * @property int $countries_id
 * 
 * @property Country $country
 * @property Collection|City[] $cities
 *
 * @package App\Models
 */
class State extends Model
{
	protected $table = 'states';
	public $timestamps = false;

	protected $casts = [
		'countries_id' => 'int'
	];

	protected $fillable = [
		'name',
		'countries_id'
	];

	public function country()
	{
		return $this->belongsTo(Country::class, 'countries_id');
	}

	public function cities()
	{
		return $this->hasMany(City::class, 'states_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $id
 * @property string $name
 * @property int $states_id
 * 
 * @property State $state
 *
 * @package App\Models
 */
class City extends Model
{
	protected $table = 'cities';
	public $timestamps = false;

	protected $casts = [
		'states_id' => 'int'
	];

	protected $fillable = [
		'name',
		'states_id'
	];

	public function state()
	{
		return $this->belongsTo(State::class, 'states_id');
	}
}

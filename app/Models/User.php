<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{

    use Page;

	protected $table = 'red_user';

	const CREATED_AT = 'create_time';

	const UPDATED_AT = null;


	protected $fillable = [
		'nick_name',
		'open_id',
		'create_time',
		'avatar',
		'total_amount',
		'sex',
		'city',
		'phone',
	];


    public function getTotalAmountAttribute($v)
    {
        return number_format($v,2);
    }
}

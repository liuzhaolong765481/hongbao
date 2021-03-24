<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $password
 * @property string|null $email
 *
 * @package App\Models
 */
class Admin extends Authenticatable
{
    use Page;

	protected $table = 'red_admin';

    public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'password',
        'email'
	];
}

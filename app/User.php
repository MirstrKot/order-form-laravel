<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Пользоватеь
 * @property integer $id
 * @property string $phone
 */
class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['phone'];
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'level', 'slug', 'telp', 'avatar', 'provider_id', 'provider', 'access_token'
  ];

  protected $guarded = ['*'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function store() {
    return $this->hasOne('App\Store')->withDefault();
  }
  public function products() {
    return $this->hasMany('App\Product');
  }
  public function banner() {
    return $this->hasMany('App\Banner');
  }

  public function profile()
  {
    return $this->hasOne('App\Profile');
  }
}

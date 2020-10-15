<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
	protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id_red_social','nombre_red_social','activo'];
    protected $table = 'cat_redes_sociales';

}

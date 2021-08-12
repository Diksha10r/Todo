<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_info extends Model
{
    use Notifiable, HasApiToken;

    protected $table="users_infos";
    protected $guard="users_infos";

    protected $fillable =[
        'user_id',
        'user_name',
        'username',
        'password',
        'status'
    ];
}

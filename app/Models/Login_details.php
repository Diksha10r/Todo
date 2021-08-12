<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login_details extends Model
{
    protected $fillable =[
        'login_id',
        'user_id',
        'login_date',
        'login_time',
        'logout_time',
        'status',
        'created_at',
        'updated_at'

    ];
}

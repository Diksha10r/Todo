<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo_list extends Model
{
    use HasFactory;
    protected $fillable =[
        'task_id',
        'id',
        'task_name',
        'status',
        'completed',
        'created_at',
        'updated_at'

    ];
}

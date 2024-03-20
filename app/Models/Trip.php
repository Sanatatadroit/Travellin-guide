<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = ['place', 'start_date', 'end_date', 'email', 'visibility','preferences' , 'user_id'];

}

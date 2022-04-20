<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $table="students";

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
    ];

    public $timestamps=false;
}

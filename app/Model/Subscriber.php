<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'patronymic',
        'birth_date',
    ];

    public $timestamps = false;
}
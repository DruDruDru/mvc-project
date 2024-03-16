<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;

class Telephone extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'telephone_number',
        'room_num',
        'subscriber_id'
    ];
}
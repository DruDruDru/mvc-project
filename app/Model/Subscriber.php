<?php

namespace Model;

use Illuminate\Database\Capsule\Manager as DB;
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

    public static function getSubscriber(int $id)
    {
        return self::where('subscriber_id', $id)->first();
    }
}
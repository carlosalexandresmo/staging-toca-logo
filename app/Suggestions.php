<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestions extends Model
{
    //
    protected $table = 'suggestions';

    protected $fillable = [
        'id_suggestions', 'name', 'phone', 'email', 'message',
    ];
}

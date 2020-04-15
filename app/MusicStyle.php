<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicStyle extends Model
{
    //
    protected $table = 'music_style';

    protected $fillable = [
        'id_music_style', 'name_style', 'enabled',
    ];

}


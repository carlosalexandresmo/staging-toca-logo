<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowAgenda extends Model
{
    //
    protected $table = 'show_agendas';

    protected $fillable = [
        'id_show', 'start', 'end', 'artistic_name', 'cache', 'music_style', 'repeat_event',
    ];
}

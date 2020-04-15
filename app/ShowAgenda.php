<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowAgenda extends Model
{
    //
    protected $table = 'show_agendas';

    protected $fillable = [
        'id_show', 'start', 'end', 'artistic_name', 'cache', 'music_style_id', 'repeat_event',
    ];

    public function music_styles() {
        return $this->hasMany(MusicStyle::class, 'music_style_id');
    }

}

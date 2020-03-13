<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    //
    protected $table = 'musician';

    protected $fillable = [
        'id_musician', 'artistic_name', 'max_value', 'min_value', 'secure_url',
    ];

    protected $hidden = [
        'id', 'abstract_text', 'max_value', 'min_value', 'starts', 'youtube_url', 'url', 'thumb_url',
        'secure_url', 'instagram_id', 'soundcloud_id', 'spotify_id', 'motivation', 'id_user_musician',
        'id_type_musician', 'created_at', 'modified_at', 'enabled', 'deleted',
    ];

}

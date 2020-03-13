<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'user';

    protected $hidden = [
        'id_mailchimp',
        'password',
        'tax_document',
        'public_id',
        'width',
        'height',
        'resource_type',
        'url',
        'secure_url',
        'json_member'];

    public function hirer() {
        return $this->hasMany('App\Hirer', 'id_user_hirer');
    }

}

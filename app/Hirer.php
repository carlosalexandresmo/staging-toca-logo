<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hirer extends Model
{
    //
    protected $table = 'hirer';

    protected $fillable = ['id'];

    const UPDATED_AT = 'modified_at';

}

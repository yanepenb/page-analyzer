<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name',
        'content_length',
        'h1',
        'response_code',
        'body',
        'keywords',
        'description'
    ];
}

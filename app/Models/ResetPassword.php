<?php

namespace Stock\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
}

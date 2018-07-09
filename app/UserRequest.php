<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $table = "UserRequests";
    public $timestamps = false;
}

<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    //
    public $timestamps = true;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::SLOTS;
}

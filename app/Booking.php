<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::BOOKING;
}
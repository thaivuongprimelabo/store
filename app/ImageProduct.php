<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utils;

class ImageProduct extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::IMAGES_PRODUCT;
    
    public function getImageLink($thumb = 'image') {
        return Utils::getImageLink($this->image, $this->$thumb);
    }
}

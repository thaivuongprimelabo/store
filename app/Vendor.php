<?php

namespace App;

use App\Constants\Common;
use App\Constants\Status;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::VENDORS;
    
    public function getName() {
        return $this->name;
    }
    
    public function getLink() {
        return route('vendor', ['slug' => $this->name_url]);
    }
    
    public function getLogo() {
        return Utils::getImageLink($this->logo);
    }
    
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
}

<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;

class PostGroups extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::POST_GROUPS;
    
    public function getLink() {
        return route('postgroups', ['slug' => $this->name_url]);
    }
    
    public function getName() {
        return $this->name;
    }
}

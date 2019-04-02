<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::CATEGORIES;
    
    public function getParentName() {
        $category = Category::select('name')->where('id', $this->parent_id)->first();
        return $category ? $category->name : '--';
    }
    
}

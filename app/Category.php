<?php

namespace App;

use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    
    public function getChildCategory() {
        $categories = Category::select('id', 'name', 'name_url')->where('parent_id', $this->id)->get();
        return $categories;
    }
    
    public function getProductInCategory() {
        $products = Product::where('status', Status::ACTIVE)->whereRaw('category_id IN (SELECT id FROM categories WHERE parent_id = ' . $this->id . ' OR id = ' . $this->id . ')')->get();
        return $products;
    }
    
    public function getLink() {
        return route('category',['slug' => $this->name_url]);
    }
    
    public function getName() {
        return $this->name;
    }
}

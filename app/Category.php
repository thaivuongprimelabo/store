<?php

namespace App;

use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Constants\ProductStatus;

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
    
    public function getProductInCategory($type) {
        
        $wheres = [
            ['status', '=', Status::ACTIVE]
        ];
        
        switch($type) {
            case ProductStatus::IS_NEW:
                array_push($wheres, ['is_new', '=', $type]);
                break;
                
            case ProductStatus::IS_BEST_SELLING:
                array_push($wheres, ['is_best_selling', '=', $type]);
                break;
                
            case ProductStatus::IS_POPULAR:
                array_push($wheres, ['is_popular', '=', $type]);
                break;
            default:
                
                break;
        }
        
        $whereIn = 'category_id IN (SELECT id FROM categories WHERE parent_id = ' . $this->id . ' OR id = ' . $this->id . ')';
        
        $products = Product::where($wheres)->whereRaw($whereIn)->get();
        return $products;
    }
    
    public function getLink() {
        return route('category',['slug' => $this->name_url]);
    }
    
    public function getName() {
        return $this->name;
    }
}

<?php

namespace App;

use App\Constants\Common;
use App\Constants\Status;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::POSTS;
    
    public function getImage() {
        return Utils::getImageLink($this->photo);
    }
    
    public function getTitle() {
        return $this->name;
    }
    
    public function getSummary() {
        return $this->description;
    }
    
    public function getSEOKeywords() {
        return $this->seo_keywords;
    }
    
    public function getSEODescription() {
        return $this->seo_description;
    }
    
    public function getCreatedAt() {
        return Utils::formatDate($this->created_at);
    }
    
    public function getPhoto() {
        return Utils::getImageLink($this->photo);
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getLink() {
        $postGroups = PostGroups::select('id','name_url')->where('id', $this->post_group_id)->where('status', Status::ACTIVE)->first();
        return route('postDetails', ['slug' => $postGroups->name_url, 'slug1' => $this->name_url]);
    }
    
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
}

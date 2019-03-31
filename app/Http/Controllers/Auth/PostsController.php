<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends AppController
{
    
    public $rules = [];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->rules = [
            'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            'content' => 'required',
            'photo' => 'image|max:' . Utils::formatMemory(Common::PHOTO_MAX_SIZE, true) . '|mimes:'. Common::IMAGE_EXT1
        ];
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Post());
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $filename = '';
                Utils::doUpload($request, Common::PHOTO_FOLDER, $filename);
                
                $data = new Post();
                $data->name              = Utils::cnvNull($request->name, '');
                $data->name_url          = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->description       = Utils::cnvNull($request->description, 0);
                $data->content           = Utils::cnvNull($request->content, '');
                $data->photo             = $filename;
                $data->published_at      = Utils::cnvNull($request->published_at, '');
                $data->published_time_at = Utils::cnvNull($request->published_time_at, '');
                $data->status            = Utils::cnvNull($request->status, 0);
                $data->created_at        = date('Y-m-d H:i:s');
                $data->updated_at        = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_posts_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_posts_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        $name = $this->name;
        return view('auth.posts.create', compact('name'));
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Post::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $data = Post::find($request->id);
                
                $filename = $data->photo;
                Utils::doUpload($request, Common::PHOTO_FOLDER, $filename);
                
                $published_at = date('Ymd', strtotime($request->input('published_at', date('Ymd'))));
                $published_time_at = date('Hi', strtotime($request->input('published_time_at', date('H:i'))));
                
                $data->name                 = Utils::cnvNull($request->name, '');
                $data->name_url             = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->description          = Utils::cnvNull($request->description, 0);
                $data->content              = Utils::cnvNull($request->content, '');
                $data->photo                = $filename;
                $data->published_at         = $published_at;
                $data->published_time_at    = $published_time_at;
                $data->status               = Utils::cnvNull($request->status, 0);
                $data->created_at           = date('Y-m-d H:i:s');
                $data->updated_at           = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        $name = $this->name;
        return view('auth.posts.edit', compact('data', 'name'));
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Post::find($id);
            if($data->delete()) {
                return redirect(route('auth_posts'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}

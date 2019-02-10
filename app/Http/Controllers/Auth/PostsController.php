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
        return view('auth.posts.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        if($request->isMethod('post')) {
            $id_search = $request->id_search;
            if(!Utils::blank($id_search)) {
                $wheres[] = ['id', '=', $id_search];
            }
            
            $name_search = $request->name_search;
            if(!Utils::blank($name_search)) {
                $wheres[] = ['name', 'LIKE', '%' . $name_search . '%'];
            }
            
            $status_search = $request->status_search;
            if(!Utils::blank($status_search)) {
                $wheres[] = ['status', '=', $status_search];
            }
        }
        
        $posts = Post::where($wheres)->paginate(Common::ROW_PER_PAGE);
        
        $paging = $posts->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.posts.ajax_list', compact('posts', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('posts', 'paging');
        }
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
                if($request->hasFile('photo')) {
                    
                    $file = $request->photo;
                    
                    $filename = Utils::uploadFile($file, Common::PHOTO_FOLDER);
                }
                
                $published_at = date('Ymd', strtotime($request->input('published_at', date('Ymd'))));
                $published_time_at = date('Hi', strtotime($request->input('published_time_at', date('H:i'))));
                
                $post = new Post();
                $post->name              = Utils::cnvNull($request->name, '');
                $post->name_url          = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $post->description       = Utils::cnvNull($request->description, 0);
                $post->content           = Utils::cnvNull($request->content, '');
                $post->photo             = $filename;
                $post->published_at      = $published_at;
                $post->published_time_at = $published_time_at;
                $post->status            = Utils::cnvNull($request->status, 0);
                $post->created_at        = date('Y-m-d H:i:s');
                $post->updated_at        = date('Y-m-d H:i:s');
                
                if($post->save()) {
                    return redirect(route('auth_posts_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_posts_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.posts.create')->withErrors($validator);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $post = Post::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $post = Post::find($request->id);
                
                $filename = $post->photo;
                if($request->hasFile('photo')) {
                    
                    $file = $request->photo;
                    
                    $filename = Utils::uploadFile($file, Common::PHOTO_FOLDER);
                }
                
                $published_at = date('Ymd', strtotime($request->input('published_at', date('Ymd'))));
                $published_time_at = date('Hi', strtotime($request->input('published_time_at', date('H:i'))));
                
                $post->name                 = Utils::cnvNull($request->name, '');
                $post->name_url             = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $post->description          = Utils::cnvNull($request->description, 0);
                $post->content              = Utils::cnvNull($request->content, '');
                $post->photo                = $filename;
                $post->published_at         = $published_at;
                $post->published_time_at    = $published_time_at;
                $post->status               = Utils::cnvNull($request->status, 0);
                $post->created_at           = date('Y-m-d H:i:s');
                $post->updated_at           = date('Y-m-d H:i:s');
                
                if($post->save()) {
                    return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.posts.edit', compact('post'))->withErrors($validator);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $post = Post::find($id);
            if($post->delete()) {
                return redirect(route('auth_posts'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}

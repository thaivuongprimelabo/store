<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            
            $maxSize =  Utils::formatMemory(Common::LOGO_MAX_SIZE, true);
            
            $messages = [
                'size' => Utils::getValidateMessage('validation.size.file', 'auth.posts.form.photo',  Utils::formatMemory(Common::PHOTO_MAX_SIZE)),
            ];
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
                'content' => 'required'
            ], $messages);
            
            if (!$validator->fails()) {
                
                $filename = '';
                if($request->hasFile('photo')) {
                    
                    $file = $request->photo;
                    
                    $filename = Utils::uploadFile($file, Common::PHOTO_FOLDER);
                }
                
                $published_at = $request->input('published_at', date('Y-m-d')) . ' ' . $request->input('published_time_at', date('H:i:s'));
                $published_at = date('Y-m-d H:i:s', strtotime($published_at));
                
                $post = new Post();
                $post->name = $request->input('name', '');
                $post->name_url = $request->input('name', '');
                $post->description = $request->input('description', 0);
                $post->content = $request->input('content', '');
                $post->photo = $filename;
                $post->published_at = $published_at;
                $post->status = $request->input('status', 0);
                $post->created_at = date('Y-m-d H:i:s');
                $post->updated_at = date('Y-m-d H:i:s');
            }
            
            if($post->save()) {
                return redirect(route('auth_posts_create'))->with('success', trans('messages.CREATE_SUCCESS'));
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
            
            $maxSize =  Utils::formatMemory(Common::PHOTO_MAX_SIZE, true);
            
            $messages = [
                'size' => Utils::getValidateMessage('validation.size.file', 'auth.posts.form.photo',  Utils::formatMemory(Common::PHOTO_MAX_SIZE)),
            ];
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
                'photo' => 'image|max:'.$maxSize.'|mimes:'. Common::IMAGE_EXT1
            ], $messages);
            
            if (!$validator->fails()) {
                $post = Post::find($request->id);
                
                $filename = $post->photo;
                if($request->hasFile('photo')) {
                    
                    $file = $request->photo;
                    
                    $filename = Utils::uploadFile($file, Common::PHOTO_FOLDER);
                }
                
                $published_at = $request->input('published_at', date('Y-m-d')) . ' ' . $request->input('published_time_at', date('H:i:s'));
                $published_at = date('Y-m-d H:i:s', strtotime($published_at));
                
                $post->name = $request->input('name', '');
                $post->name_url = $request->input('name', '');
                $post->description = $request->input('description', 0);
                $post->content = $request->input('content', '');
                $post->photo = $filename;
                $post->published_at = $published_at;
                $post->status = $request->input('status', 0);
                $post->created_at = date('Y-m-d H:i:s');
                $post->updated_at = date('Y-m-d H:i:s');
            }
            
            if($post->save()) {
                return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
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

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Page;
use App\Helpers\Utils;

class PagesController extends AppController
{
    //
    public function about(Request $request) {
        $data = Page::find(1);
        if($request->isMethod('post')) {
            if(!$data) {
                $data = new Page();
                $data->created_at    = date('Y-m-d H:i:s');
            }
            $data->content       = Utils::cnvNull($request->content, '');
            $data->updated_at    = date('Y-m-d H:i:s');
            
            if($data->save()) {
                return redirect(route('auth_pages_about'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        $name = 'pages';
        return view('auth.pages.about.index', compact('data', 'name'));
    }
}

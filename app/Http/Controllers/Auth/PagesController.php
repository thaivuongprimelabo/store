<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Page;
use App\Helpers\Utils;

class PagesController extends AppController
{
    //
    public function about(Request $request) {
        $about = Page::find(1);
        if($request->isMethod('post')) {
            if(!$about) {
                $about = new Page();
                $about->created_at    = date('Y-m-d H:i:s');
            }
            $about->name          = Utils::cnvNull($request->name, '');
            $about->content       = Utils::cnvNull($request->content, '');
            $about->updated_at    = date('Y-m-d H:i:s');
            
            if($about->save()) {
                return redirect(route('auth_pages_about'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        return view('auth.pages.about.index', compact('about'));
    }
    
    public function delivery(Request $request) {
        $delivery = Page::find(2);
        if($request->isMethod('post')) {
            if(!$delivery) {
                $delivery = new Page();
                $delivery->created_at    = date('Y-m-d H:i:s');
            }
            $delivery->name          = Utils::cnvNull($request->name, '');
            $delivery->content       = Utils::cnvNull($request->content, '');
            $delivery->updated_at    = date('Y-m-d H:i:s');
            
            if($delivery->save()) {
                return redirect(route('auth_pages_delivery'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        return view('auth.pages.delivery.index', compact('delivery'));
    }
}

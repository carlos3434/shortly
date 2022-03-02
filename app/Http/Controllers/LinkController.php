<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Http\Requests\LinkCreate;
use Illuminate\Support\Str;
use App\Jobs\Crawler;

class LinkController extends Controller
{
    public function index(){
        $links = Link::paginate(10);
        return view('dashboard.link.index', compact('links'));
    }
    public function create(){
        return view('dashboard.link.create');
    }
    public function store(LinkCreate $request){
        $link = new Link;
        $link->name = $request->input('name');
        $link->url = $request->input('url');
        $link->short = Str::random(10);
        $link->count = 0;
        $link->save();
        return redirect()->route('links.index');
    }
    public function short(Request $request, $short){
        $links = Link::where('short',$short)->get();
        if (count($links)>0 && isset($links[0]->id)) {
            $link = Link::find($links[0]->id);
            $link->count ++;
            $link->save();
            return redirect()->away($link->url);
        }
        return ['not found'];
    }
    //job
    public function update(Request $request, $id)
    {
        $link = Link::find($id);
        Crawler::dispatch($link)->delay( now()->addSeconds(10) );

        return redirect()->route('links.index');
    }
}

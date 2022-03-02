<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Link;

class LinkController extends Controller
{
    /**
     * 100 URLs most frequently accessed, including the title crawled
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $links = Link::orderBy('count','DESC')->take(100)->get();

        return $links;
    }
}
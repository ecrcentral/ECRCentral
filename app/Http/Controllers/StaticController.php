<?php

namespace App\Http\Controllers;
use TCG\Voyager\Models\Page;
use App\Traits\CaptureIpTrait;
use Illuminate\Http\Request;
use Validator;

class StaticController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

     /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $page = Page::where('slug', 'about')->first();

        return view('page')->withpage($page);
    }
}

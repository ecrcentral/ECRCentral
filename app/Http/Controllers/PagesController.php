<?php

namespace App\Http\Controllers;
use TCG\Voyager\Models\Page;
use App\Models\User;
use TCG\Voyager\Models\Role;
use App\Traits\CaptureIpTrait;
use Illuminate\Http\Request;
use Validator;

use App\Models\Funding;
use App\Models\Subject;
use TCG\Voyager\Models\Post;
use App\Models\TravelGrant;



use App\Models\Funder;

class PagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $month = date('F', time());

        $fundings = Funding::where('deadline', 'LIKE', '%' . $month . '%')->paginate(5);
        $featured_fundings = Funding::where('featured', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $featured_travelgrants = TravelGrant::where('featured', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $posts = Post::orderBy('id', 'asc')->paginate(5);

        $total_fundings = Funding::count();
        $total_travelgrants = TravelGrant::count();

        $data = [
            'fundings' => $fundings,
            'posts' => $posts,
            'total_fundings' => $total_fundings,
            'total_travelgrants' => $total_travelgrants,
            'featured_fundings' => $featured_fundings,
            'featured_travelgrants' => $featured_travelgrants,
            'host_countries' => Funding::select('host_country')->distinct()->get(),
            'applicant_countries' => Funding::select('applicant_country')->distinct()->get(),
            #'subjects' => Subject::all(),
        ];

        return View('home')->with($data);
    }

    public function show($slug)
    {   

        $page = Page::where('slug', $slug)->first();

        return view('page')->withpage($page);
    }

    public function community(Request $request)
    {
        $users = User::with('profile')->where('activated', 1)->paginate(env('USER_LIST_PAGINATION_SIZE'));


        return View('community', compact('users'));
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        $page = Page::where('slug', 'about')->first();

        return view('team')->withpage($page);
    }

    public function privacy()
    {
        $page = Page::where('slug', 'privacy')->first();

        return view('page')->withpage($page);
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms')->first();

        return view('page')->withpage($page);
    }

    public function contact()
    {
        $page = Page::where('slug', 'contact')->first();

        return view('contact-us')->withpage($page);
    }

    public function get_involved()
    {
        $page = Page::where('slug', 'get-involved')->first();

        return view('page')->withpage($page);
    }

    


}

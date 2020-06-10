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
use App\Models\Resource;

use Image;

use App\Models\Funder;
use DevDojo\Chatter\Models\Models;

class PagesController extends Controller
{
    /**
     * Show user avatar.
     *
     * @param $id
     * @param $image
     *
     * @return string
     */
    public function userProfileAvatar($id, $image)
    {
        return Image::make(storage_path().'/users/id/'.$id.'/uploads/images/avatar/'.$image)->response();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $month = date('F', time());

        $fundings = Funding::where('deadline', 'LIKE', '%' . $month . '%')->take(5)->get();
        $featured_fundings = Funding::where('featured', 1)->orderBy('updated_at', 'desc')->take(7)->get();
        $featured_travelgrants = TravelGrant::where('featured', 1)->orderBy('updated_at', 'desc')->take(7)->get();
        $featured_resources = Resource::where('featured', 1)->orderBy('updated_at', 'desc')->take(5)->get();
        //$posts = Post::orderBy('id', 'asc')->paginate(5);

        $total_fundings = Funding::where('status', '=', 1)->count();
        $total_travelgrants = TravelGrant::where('status', '=', 1)->count();
        $total_resources = Resource::where('status', '=', 1)->count();
  
        $discussions = Models::discussion()->with('user')->with('post')->with('postsCount')->with('category')->orderBy(config('chatter.order_by.discussions.order'), config('chatter.order_by.discussions.by'))->take(5)->get();
        if (isset($slug)) {
            $category = Models::category()->where('slug', '=', $slug)->first();
            
            if (isset($category->id)) {
                $current_category_id = $category->id;
                $discussions = $discussions->where('chatter_category_id', '=', $category->id);
            } else {
                $current_category_id = null;
            }
        }
        
        $data = [
            'fundings' => $fundings,
            //'posts' => $posts,
            'total_fundings' => $total_fundings,
            'total_travelgrants' => $total_travelgrants,
            'total_resources' => $total_resources,
            'featured_fundings' => $featured_fundings,
            'featured_travelgrants' => $featured_travelgrants,
            'host_countries' => Funding::select('host_country')->distinct()->get(),
            'applicant_countries' => Funding::select('applicant_country')->distinct()->get(),
            //'posts' => $posts,
            'discussions' => $discussions,
            'featured_resources' => $featured_resources,
            #'subjects' => Subject::all(),
        ];

        return View('home')->with($data);
    }

    public function show($slug)
    {   

        $page = Page::where('slug', $slug)->firstOrFail();

        return view('page')->withpage($page);
    }

    public function community($rolename='user')
    {
        if($rolename =='member')
        {
           $rolename = 'user';
        }
        $role = Role::where('name', $rolename)->firstOrFail();
        if($role){
            $members = User::with('profile')->where('activated', 1)->where('role_id', $role->id)->orderBy('last_login_at', 'DESC')->paginate(env('USER_LIST_PAGINATION_SIZE'));
            }else
            {
              $members = User::with('profile')->where('activated', 1)->orderBy('last_login_at', 'DESC')->paginate(env('USER_LIST_PAGINATION_SIZE'));
            }
        return View('community', compact('members'));
    }

    public function community_all(Request $request)
    {
        $members = User::with('profile')->where('activated', 1)->orderBy('last_login_at', 'DESC')->paginate(env('USER_LIST_PAGINATION_SIZE'));


        return View('community', compact('members'));
    }

    public function moderators(Request $request)
    {
        $moderators = User::with('profile')->where('role_id', 4)->orderBy('last_login_at', 'DESC')->paginate(env('USER_LIST_PAGINATION_SIZE'));


        return View('moderators', compact('moderators'));
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
        $page = Page::where('slug', 'about')->firstOrFail();

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
        $page = Page::where('slug', 'team')->firstOrFail();

        return view('team')->withpage($page);
    }

    public function privacy()
    {
        $page = Page::where('slug', 'privacy')->firstOrFail();

        return view('page')->withpage($page);
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms')->firstOrFail();

        return view('page')->withpage($page);
    }

    public function contact()
    {
        $page = Page::where('slug', 'contact')->firstOrFail();

        return view('contact-us')->withpage($page);
    }

    public function get_involved()
    {
        $page = Page::where('slug', 'get-involved')->firstOrFail();

        return view('page')->withpage($page);
    }

    


}

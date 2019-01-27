<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\ResourceCategory;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;

use Auth;

use Mail;
use App\Mail\ResourceAdded;

class resourcesController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Resource::where('status', 1);

        $request_append = array();

        if($request->has('q')) {

            $query_string = $request->input('q');

            $request_append['q'] = $query_string;

            $resources = $resources->where('name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('source_name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('description', 'LIKE', '%' . $query_string . '%');
        }

        

        $resources = $resources->paginate(env('USER_LIST_PAGINATION_SIZE'))->appends($request_append);

        return View('resources.show-resources', compact('resources'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resources = Resource::all();
        $categories = ResourceCategory::all();

        $data = [
            'resources' => $resources,
            'categories' => $categories,
        ];

        return view('resources.create-resource')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'source_name' => 'required',
                'url' => 'url|required',
                'categories' => 'required',
                'published_at' => 'nullable|date',
            ],
            [
                'name.required'       => trans('resources.resourceNameRequired'),
                'source_name.required' => trans('resources.sourceNameRequired'),
                'url.required'  => trans('resources.urlRequired'),
                'categories.required'  => trans('resources.categoriesRequired'),

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $resource = new resource();

        if(Auth::user()){
            $user_id = Auth::id();
        }else{
            $user_id = 1;
        }

        $resource = Resource::create([
            'name' => $request->input('name'),
            'source_name' => $request->input('source_name'),
            'description' => $request->input('description'),            
            'url' => $request->input('url'),
            'logo' => $request->input('logo'),
            'published_at' => $request->input('published_at'),
            'status' => 0,
            'featured' => 0,
            'user_id' => $user_id,
         
        ]);

        $categories =  $request->input('categories');

        $resource->save();
        $resource->categories()->sync($categories);

        Mail::to('azez.khan@gmail.com')->send(new resourceAdded($resource));

        return redirect('resources')->with('success', trans('resources.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #$resource = resource::find($id);
        $resource = Resource::where('slug', '=', $id)->orWhere('id', '=', $id)->firstOrFail();

        $related_resources = Resource::where('id', "!=", $resource->id)
            ->orWhere('name', 'LIKE', '%' . $resource->name . '%')
            ->orWhere('description', 'LIKE', '%' . $resource->description . '%')->take(8)->get();

        $data = [
            'resource'        => $resource,
            'related_resources' => $related_resources,
        ];

        return view('resources.show-resource')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Resource::findOrFail($id);
          
        $data = [
            'resource'        => $resource,
        ];

        return view('resources.edit-resource')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = resource::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        
         #$resource->deleted_ip_address = $ipAddress->getClientIp();
         $resource->save();
         $resource->delete();

         return redirect('resources')->with('success', trans('resources.deleteSuccess'));

    }
}

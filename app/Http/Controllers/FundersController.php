<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\Funder;
use App\Models\TravelGrant;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;


class FundersController extends Controller
{
    

    /**
     * Display a list of funders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $funders = new Funder;

        $request_append = array();

        if($request->has('country')) {
            $funders = $funders->where('country', $request->input('country'));
            $request_append['country'] = $request->input('country');
        }

        if($request->has('q')) {

            $query_string = $request->input('q');

            $request_append['q'] = $query_string;

            $funders = $funders->where('name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('country', 'LIKE', '%' . $query_string . '%')
            ->orWhere('funder_id', 'LIKE', '%' . $query_string . '%');
        }

        

        $funders = $funders->paginate(env('USER_LIST_PAGINATION_SIZE'))->appends($request_append);

        $data = [
            'funders' => $funders,
            'countries' => Funder::select('country')->distinct()->get(),
        ];

        return View('funders.show-funders')->with($data);
    
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funders = Funder::all();

        $data = [
            'funders' => $funders,
        ];

        return view('funders.create-funder')->with($data);
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
                'country' => 'required',
                'funder_id' => 'required|unique',
                'url' => '',
                'logo' => '',
               
            ],
            [
                #'name.unique'         => trans('auth.funderNameTaken'),
                #'name.required'       => trans('auth.funderNameRequired'),
                #'first_name.required' => trans('auth.fNameRequired'),
                #'last_name.required'  => trans('auth.lNameRequired'),
                #'email.required'      => trans('auth.emailRequired'),
                #'email.email'         => trans('auth.emailInvalid'),
                #'password.max'        => trans('auth.PasswordMax'),
                #'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $funder = new Funder();

        $funder = Funder::create([
            'name'             => $request->input('name'),
            'funder_id'       => $request->input('funder_id'),
            'country'        => $request->input('country'),
            'url'            => $request->input('url'),
            'logo'         => $request->input('logo'),
         
        ]);

        #$funder->funder()->save($funder);
        $funder->save();

        return redirect('funders')->with('success', trans('funders.createSuccess'));
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
        $funder = Funder::where('id', '=', $id)->orWhere('slug', '=', $id)->firstOrFail();

        $fundings = Funding::where('funder_name', $funder['name']);
        $travelgrants = TravelGrant::where('funder_name', $funder['name']);

        $data = [
            'funder' => $funder,
            'fundings' => $fundings,
            'travelgrants' => $travelgrants,
        ];

        return view('funders.show-funder')->with($data);
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
        $funder = Funder::findOrFail($id);
          
        $data = [
            'funder'        => $funder,
        ];

        return view('funders.edit-funder')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $funder = Funder::find($id);
     

      
        $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'funder_id' => 'required',
                'country' => 'required',
            ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $funder->name = $request->input('name');
        $funder->country = $request->input('country');
        $funder->funder_id = $request->input('funder_id');
        $funder->url = $request->input('url');
        $funder->logo = $request->input('logo');

        
        $funder->save();

        return back()->with('success', trans('funders.updateSuccess'));
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
        $funder = Funder::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        
         $funder->deleted_ip_address = $ipAddress->getClientIp();
         $funder->save();
         $funder->delete();

         return redirect('funders')->with('success', trans('funders.deleteSuccess'));

    }
}
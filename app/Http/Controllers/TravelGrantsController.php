<?php

namespace App\Http\Controllers;

use App\Models\TravelGrant;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;


class travelgrantsController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q', 'None');

        if($q != '' and $q != 'None') {
       		$travelgrants = TravelGrant::where('name', 'LIKE', '%' . $q . '%')->orWhere('funder_name', 'LIKE', '%' . $q . '%')->paginate(env('USER_LIST_PAGINATION_SIZE'));
    	}else{

        	$travelgrants = TravelGrant::paginate(100);
        }

        return View('travelgrants.show-travelgrants', compact('travelgrants'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $travelgrants = TravelGrant::all();

        $data = [
            'travelgrants' => $travelgrants,
        ];

        return view('travelgrants.create-travelgrant')->with($data);
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
                'funder_name' => 'required',
                #'funder_id' => 'required|unique',
                'url' => 'required',
                'logo' => '',
               
            ],
            [
                #'name.unique'         => trans('auth.travelgrantNameTaken'),
                #'name.required'       => trans('auth.travelgrantNameRequired'),
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
        $travelgrant = new TravelGrant();

        $travelgrant = TravelGrant::create([
            'name'             => $request->input('name'),
            'travelgrant_id'       => $request->input('travelgrant_id'),
            'country'        => $request->input('country'),
            'url'            => $request->input('url'),
            'logo'         => $request->input('logo'),
         
        ]);

        #$travelgrant->travelgrant()->save($travelgrant);
        $travelgrant->save();

        return redirect('travelgrants')->with('success', trans('travelgrants.createSuccess'));
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
        $travelgrant = TravelGrant::find($id);

        return view('travelgrants.show-travelgrant')->withtravelgrant($travelgrant);
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
        $travelgrant = TravelGrant::findOrFail($id);
          
        $data = [
            'travelgrant'        => $travelgrant,
        ];

        return view('travelgrants.edit-travelgrant')->with($data);
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
        $travelgrant = TravelGrant::find($id);
      
        $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'funder_name' => 'required',
                'host_country' => 'required',
                'url' => 'url',
            ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $travelgrant->name = $request->input('name');
        $travelgrant->funder_name = $request->input('funder_name');
        $travelgrant->funder_id = $request->input('funder_id');
        $travelgrant->url = $request->input('url');
        $travelgrant->applicant_country = $request->input('applicant_country');
        $travelgrant->membership = $request->input('membership');
        $travelgrant->description = $request->input('description');
        $travelgrant->membership_time = $request->input('membership_time');
        $travelgrant->award = $request->input('award');
        $travelgrant->purpose = $request->input('purpose');
        $travelgrant->deadline = $request->input('deadline');
        $travelgrant->subjects = $request->input('subjects');
        $travelgrant->diversity = $request->input('diversity');
        $travelgrant->comments = $request->input('comments');

        $travelgrant->save();

        return back()->with('success', trans('travelgrants.updateSuccess'));
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
        $travelgrant = TravelGrant::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        
         $travelgrant->deleted_ip_address = $ipAddress->getClientIp();
         $travelgrant->save();
         $travelgrant->delete();

         return redirect('travelgrants')->with('success', trans('travelgrants.deleteSuccess'));

    }
}

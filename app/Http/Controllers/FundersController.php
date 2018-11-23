<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\Funder;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;


class FundersController extends Controller
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
       		$funders = Funder::where('name', 'LIKE', '%' . $q . '%')
       		->orWhere('country', 'LIKE', '%' . $q . '%')
       		->orWhere('funder_id', 'LIKE', '%' . $q . '%')
       		->paginate(env('USER_LIST_PAGINATION_SIZE'));
    	}else{

        	$funders = Funder::orderBy('funder_id', 'asc')->paginate(env('USER_LIST_PAGINATION_SIZE'));
        }

        return View('funders.show-funders', compact('funders'));
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
        $funder = Funder::find($id);

        return view('funders.show-funder')->withfunder($funder);
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
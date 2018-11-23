<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\Subject;

use App\Models\Funder;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;


class FundingsController extends Controller
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
       		$fundings = Funding::where('name', 'LIKE', '%' . $q . '%')->orWhere('funder_name', 'LIKE', '%' . $q . '%')->paginate(env('USER_LIST_PAGINATION_SIZE'));
    	}else{

        	$fundings = Funding::paginate(env('USER_LIST_PAGINATION_SIZE'));
        }

        //phd=6&applicant=New+Zealand&host=New+Zealand&subjects=1&q=


        $data = [
            'fundings' => $fundings,
            'host_countries' => Funding::select('host_country')->distinct()->get(),
            'applicant_countries' => Funding::select('applicant_country')->distinct()->get(),
            'years_since_phd' => Funding::select('years_since_phd')->distinct()->get(),
            'subjects' => Subject::all(),
        ];

        return View('fundings.show-fundings')->with($data);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fundings = Funding::all();

        $data = [
            'fundings' => $fundings,
        ];

        return view('fundings.create-funding')->with($data);
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
                #'name.unique'         => trans('auth.fundingNameTaken'),
                #'name.required'       => trans('auth.fundingNameRequired'),
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
        $funding = new Funding();

        $funding = Funding::create([
            'name'             => $request->input('name'),
            'funding_id'       => $request->input('funding_id'),
            'country'        => $request->input('country'),
            'url'            => $request->input('url'),
            'logo'         => $request->input('logo'),
         
        ]);

        #$funding->funding()->save($funding);
        $funding->save();

        return redirect('fundings')->with('success', trans('fundings.createSuccess'));
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
        $funding = Funding::find($id);

        return view('fundings.show-funding')->withfunding($funding);
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
        $funding = Funding::findOrFail($id);
          
        $data = [
            'funding'        => $funding,
        ];

        return view('fundings.edit-funding')->with($data);
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
        $funding = Funding::find($id);
      
        $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'funder_name' => 'required',
                'host_country' => 'required',
                'url' => 'url',
            ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $funding->name = $request->input('name');
        $funding->host_country = $request->input('host_country');
        $funding->funder_name = $request->input('funder_name');
        $funding->url = $request->input('url');
        $funding->applicant_country = $request->input('applicant_country');
        $funding->years_since_phd = $request->input('years_since_phd');
        $funding->description = $request->input('description');
        $funding->academic_level = $request->input('academic_level');
        $funding->duration = $request->input('duration');
        $funding->award = $request->input('award');
        $funding->award_type = $request->input('award_type');
        $funding->research_costs = $request->input('research_costs');
        $funding->deadline = $request->input('deadline');
        $funding->subjects = $request->input('subjects');
        $funding->diversity = $request->input('diversity');
        $funding->comments = $request->input('comments');

        $funding->save();

        return back()->with('success', trans('fundings.updateSuccess'));
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
        $funding = Funding::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        
         $funding->deleted_ip_address = $ipAddress->getClientIp();
         $funding->save();
         $funding->delete();

         return redirect('fundings')->with('success', trans('fundings.deleteSuccess'));

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\Subject;

use App\Models\Funder;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Mail\FundingAdded;

use Auth;


class FundingsController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $fundings = Funding::where('status', 1);

        $request_append = [];
    
        if($request->has('host_country')) {
            $fundings = $fundings->where('host_country', $request->input('host_country'));
            $request_append['host_country'] = $request->input('host_country');
        }
        if($request->has('applicant_country')) {
            $fundings = $fundings->where('applicant_country', $request->input('applicant_country'));
            $request_append['applicant_country'] = $request->input('applicant_country');

        }
        if($request->has('q')) {

            $query_string = $request->input('q');
            $request_append['q'] = $request->input('q');
        
            $fundings = $fundings->where('name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('funder_name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('host_country', 'LIKE', '%' . $query_string . '%')
            ->orWhere('years_since_phd', 'LIKE', '%' . $query_string . '%');
        }      


        $fundings = $fundings->paginate(env('USER_LIST_PAGINATION_SIZE'))->appends($request_append);


        $data = [
            'fundings' => $fundings,
            'host_countries' => Funding::select('host_country')->distinct()->get(),
            'applicant_countries' => Funding::select('applicant_country')->distinct()->get(),
            #'years_since_phd' => Funding::select('years_since_phd')->distinct()->get(),
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
                'url' => 'url|required',
            ],
            [
                'name.required'       => trans('fundings.fundingNameRequired'),
                'funder_name.required' => trans('fundings.funderNameRequired'),
                'url.required'  => trans('fundings.urlRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $funding = new Funding();

        if(Auth::user()){
            $user_id = Auth::id();
        }else{
            $user_id = 1;
        }

        $funding = Funding::create([
            'name' => $request->input('name'),
            'funder_name' => $request->input('funder_name'),
            'description' => $request->input('description'),            
            'host_country' => $request->input('host_country'),
            'applicant_country' => $request->input('applicant_country'),
            'url' => $request->input('url'),
            'award' => $request->input('award'),
            'years_since_phd' => $request->input('years_since_phd'),
            'deadline' => $request->input('deadline'),
            'comments' => $request->input('comments'),
            'benefits' => $request->input('benefits'),
            'fileds' => $request->input('fileds'),
            'mobility_rule' => $request->input('mobility_rule'),
            'research_costs' => $request->input('research_costs'),
            #'status' => $request->input('status'),
            'status' => 0,
            'featured' => 0,
            'user_id' => $user_id,
         
        ]);

        $funding->save();

        Mail::to('azez.khan@gmail.com')->send(new FundingAdded($funding));

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
        #$funding = Funding::find($id);

        $funding = Funding::where('id', '=', $id)->orWhere('slug', '=', $id)->firstOrFail();

        $related_fundings = Funding::where('id', "!=", $funding->id)
            ->where('applicant_country', 'LIKE', '%' . $funding->applicant_country . '%')
            ->orWhere('host_country', 'LIKE', '%' . $funding->host_country . '%')->take(8)->get();

        $data = [
            'funding'        => $funding,
            'related_fundings' => $related_fundings,
        ];

        return view('fundings.show-funding')->with($data);
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

        
         #$funding->deleted_ip_address = $ipAddress->getClientIp();
         $funding->save();
         $funding->delete();

         return redirect('fundings')->with('success', trans('fundings.deleteSuccess'));

    }

}

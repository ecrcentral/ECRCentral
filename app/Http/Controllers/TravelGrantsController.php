<?php

namespace App\Http\Controllers;

use App\Models\TravelGrant;
use App\Models\TravelPurpose;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;

use Auth;

use Mail;
use App\Mail\TravelGrantAdded;

class travelgrantsController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $travelgrants = TravelGrant::where('status', 1);

        $request_append = array();

        if($request->has('q')) {

            $query_string = $request->input('q');

            $request_append['q'] = $query_string;

            $travelgrants = $travelgrants->where('name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('funder_name', 'LIKE', '%' . $query_string . '%')
            ->orWhere('applicant_country', 'LIKE', '%' . $query_string . '%')
            ->orWhere('fields', 'LIKE', '%' . $query_string . '%');
        }

        if($request->has('applicant_country')) {

            $travelgrants = $travelgrants->where('applicant_country', $request->input('applicant_country'));

            $request_append['applicant_country'] = $request->input('applicant_country');
        }


        $travelgrants = $travelgrants->paginate(env('USER_LIST_PAGINATION_SIZE'))->appends($request_append);

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
        $purposes = TravelPurpose::all();

        $data = [
            'travelgrants' => $travelgrants,
            'purposes' => $purposes,
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
                'url' => 'url|required',
                'purposes' => 'required',
            ],
            [
                'name.required'       => trans('travelgrants.fundingNameRequired'),
                'funder_name.required' => trans('travelgrants.funderNameRequired'),
                'url.required'  => trans('travelgrants.urlRequired'),
                'purposes.required'  => trans('travelgrants.purposesRequired'),

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $travelgrant = new TravelGrant();

        if(Auth::user()){
            $user_id = Auth::id();
        }else{
            $user_id = 1;
        }

        $travelgrant = TravelGrant::create([
            'name' => $request->input('name'),
            'funder_name' => $request->input('funder_name'),
            'description' => $request->input('description'),            
            'applicant_country' => $request->input('applicant_country'),
            'url' => $request->input('url'),
            'award' => $request->input('award'),
            'deadline' => $request->input('deadline'),
            'comments' => $request->input('comments'),
            'membership' => $request->input('membership'),
            'membership_time' => $request->input('membership_time'),
            'fields' => $request->input('fields'),
            'diversity' => $request->input('diversity'),
            'career_level' => $request->input('career_level'),
            #'status' => $request->input('status'),
            'status' => 0,
            'featured' => 0,
            'user_id' => $user_id,
         
        ]);

        $purposes =  $request->input('purposes');

        $travelgrant->save();
        $travelgrant->purposes()->sync($purposes);

        Mail::to('azez.khan@gmail.com')->send(new TravelGrantAdded($travelgrant));

        return redirect('travel-grants')->with('success', trans('travelgrants.createSuccess'));
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
        #$travelgrant = TravelGrant::find($id);
        $travelgrant = TravelGrant::where('slug', '=', $id)->orWhere('id', '=', $id)->firstOrFail();

        $related_travelgrants = TravelGrant::where('id', "!=", $travelgrant->id)
            ->where('purpose', 'LIKE', '%' . $travelgrant->purpose . '%')->take(8)->get();
    

        $data = [
            'travelgrant'        => $travelgrant,
            'related_travelgrants' => $related_travelgrants,
        ];

        return view('travelgrants.show-travelgrant')->with($data);
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

        
         #$travelgrant->deleted_ip_address = $ipAddress->getClientIp();
         $travelgrant->save();
         $travelgrant->delete();

         return redirect('travel-grants')->with('success', trans('travelgrants.deleteSuccess'));

    }
}

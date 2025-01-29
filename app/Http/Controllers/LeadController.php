<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $leads = Lead::all();
        return view('lead.list' ,compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Dropdown options
        $assignees = ['Swati', 'Mohit', 'Aakriti', 'Vikash', 'Hemendra'];
        $services = ['Consultation', 'Development', 'Support', 'Marketing'];
        $statuses = ['enquiry', 'npc', 'not', 'fake','interested','closedwith','language','low','caf','postponed','closed'];
        $sources = ['Website', 'Social Media', 'Referral', 'Advertisement'];
       return view('lead.create',compact('assignees','services','statuses','sources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
       $validated = $request->validate([
            'assignee' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'budget' => 'nullable|string',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'city' => 'nullable|string',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
            'last_follow_up_date' => 'nullable|date',
            'follow_up_date' => 'nullable|date',
        ]);

        lead::create($validated);
        return redirect()->route('lead.index')->with('success','lead created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function viewedit(string $id)
    {
        $lead = Lead::findOrFail($id);
        $assignees = ['Swati', 'Mohit', 'Aakriti', 'Vikash', 'Hemendra'];
        $services = ['Consultation', 'Development', 'Support', 'Marketing'];
        $statuses = ['enquiry', 'npc', 'not', 'fake','interested','closedwith','language','low','caf','postponed','closed'];
        $sources = ['Website', 'Social Media', 'Referral', 'Advertisement'];

        return view('lead.viewedit', compact('lead', 'assignees', 'services', 'statuses', 'sources'));
    }
    // public function edit(string $id)
    // {
    //     $lead = Lead::findOrFail($id);
    //     $services = $lead->service;
    //     $descriptions= $lead->description;
    //     $followupdate = $lead->follow_up_date;
    //     $status = $lead->status;

    //     // dd($services,$descriptions,$followdate,$status);

    //     return view('lead.edit',compact('lead','services','descriptions','followupdate','status'));


    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
            {
                     // Validate the form data
            $validated = $request->validate([
                'assignee' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'source' => 'required|string|max:255',
                'budget' => 'nullable|numeric',
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'city' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'description' => 'nullable|string',
                'last_follow_up_date' => 'nullable|date',
                'follow_up_date' => 'nullable|date',
            ]);

            // Find the lead by its ID
            $lead = Lead::findOrFail($id);

            // Save current lead data to history before updating
            LeadHistory::create([
                'lead_id' => $lead->id,
                'assignee' => $lead->assignee,
                'service' => $lead->service,
                'status' => $lead->status,
                'source' => $lead->source,
                'budget' => $lead->budget,
                'full_name' => $lead->full_name,
                'phone_number' => $lead->phone_number,
                'city' => $lead->city,
                'email' => $lead->email,
                'description'=>$lead->description,
                'last_follow_up_date' =>$lead->last_follow_up_date,
                'follow_up_date' => $lead->follow_up_date,
            ]);



            // Update lead with the form data
            $lead->assignee = $request->assignee == 'other' ? $request->assignee_other : $request->assignee;
            $lead->service = $request->service == 'other' ? $request->service_other : $request->service;
            $lead->status = $request->status == 'other' ? $request->status_other : $request->status;
            $lead->source = $request->source == 'other' ? $request->source_other : $request->source;
            $lead->budget = $request->budget;
            $lead->full_name = $request->full_name;
            // $lead->phone_number = $request->phone_number;
            $lead->city = $request->city;
            // $lead->email = $request->email;
            $lead->description = $request->description;
            // $lead->last_follow_up_date = $request->last_follow_up_date;
            $lead->follow_up_date = $request->follow_up_date;

            // Save the updated lead
            $lead->save();

            // Redirect back to the lead index with success message
            return redirect()->route('lead.index')->with('success', 'Lead updated successfully and saved history table');
        }




        public function editupdate(Request $request, string $id)
        {

            //    dd($request->all(),$id);
                 // Validate the form data
        $validated = $request->validate([

            'service' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        // Find the lead by its ID
        $lead = Lead::findOrFail($id);
        // dd($id);



        // Save current lead data to history before updating
        LeadHistory::create([
            'lead_id' => $lead->id,
            'assignee' => $lead->assignee,
            'service' => $lead->service,
            'status' => $lead->status,
            'source' => $lead->source,
            'budget' => $lead->budget,
            'full_name' => $lead->full_name,
            'phone_number' => $lead->phone_number,
            'city' => $lead->city,
            'email' => $lead->email,
            'description'=>$lead->description,
            'last_follow_up_date' =>$lead->last_follow_up_date,
            'follow_up_date' => $lead->follow_up_date,
            'follow_up' => 'done',
        ]);



        // Update lead with the form data

        $lead->service = $request->service;
        $lead->status =  $request->status;
        // $lead->source = $request->source == 'other' ? $request->source_other : $request->source;
        // $lead->budget = $request->budget;
        // $lead->full_name = $request->full_name;
        // $lead->phone_number = $request->phone_number;
        // $lead->city = $request->city;
        // $lead->email = $request->email;
        $lead->description = $request->description;

        // $lead->last_follow_up_date = $request->last_follow_up_date;
        $lead->follow_up_date = $request->follow_up_date;

        // Save the updated lead
        // dd($lead);
        $lead->save();

        // Redirect back to the lead index with success message
        return redirect()->route('lead.index')->with('success', 'Lead updated successfully and saved history table');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      dd('delete method working',$id);
    }



    public function history(string$id){
        // dd(DB::table('lead_histories')->get());

       // dd($id);

    //    $leadhistorys= LeadHistory::findOrFail($id);
       $leadhistorys= LeadHistory::where('lead_id',$id)->get();

//dd($leadhistorys);

       return view('lead.history',compact('leadhistorys'));

    }
}

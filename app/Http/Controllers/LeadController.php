<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\LeadsMaster;


class LeadController extends Controller implements HasMiddleware
{


    public static function middleware() : array
    {

        return[
           new Middleware('permission:Add Lead', only: ['create']),
           new Middleware('permission:edit lead', only: ['editupdate']),
           new Middleware('permission:view-edit lead', only: ['update']),
           new Middleware('permission:history lead', only: ['history']),
           new Middleware('permission:Delete Lead', only:['destroy'] ),
       ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $leads = Lead::orderBy('created_at','desc')->paginate(10);
        //  $id = Auth::id();
        //  $name = Admin::where('name',$name)->first();
        //  $leads = Lead::where('assignee',$name)->get();
        // dd($userName);


        // add admin permision
         $userName =   $userName = DB::table('admins')->where('id', Auth::id())->value('name');

            if (Auth::user()->can('View Lead')) {

                $leads = Lead::orderBy('created_at','desc')->paginate(10);

            } else {
                $leads = Lead::where('assignee', $userName)->get(); // Normal user ho to sirf uski leads dikhao
            }
            // $leads = Lead::where('assignee', $userName)->get(); // Assignee se match karein
            //dd($leads);



            // get colors from lead master table
            $services = LeadsMaster::where('type', 'service')->pluck('bg_color', 'name');
            $statuses = LeadsMaster::where('type', 'status')->pluck('bg_color', 'name');
            $sources  = LeadsMaster::where('type', 'source')->pluck('bg_color', 'name');
        return view('lead.list' ,compact('leads','services','statuses','sources'));
    }

    // public function own(){
    //     $userName =   $userName = DB::table('admins')->where('id', Auth::id())->value('name');
    //     $leads = Lead::where('assignee', $userName)->get();
    //     return view('lead.list' ,compact('leads'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Dropdown options
        // $assignees = Lead::pluck('assignee');
        // dd($assignees);
        // $assignees = ['Swati', 'Mohit', 'Aakriti', 'Vikash', 'Hemendra'];

        // $services = ['Consultation', 'Development', 'Support', 'Marketing'];

        $assignees = DB::table('admins')->pluck('name');

        // $services = Lead::pluck('service');
        // $statuses = ['enquiry', 'npc', 'not', 'fake','interested','closedwith','language','low','caf','postponed','closed'];
        // $statuses = Lead::pluck('status');
        // $sources = ['Website', 'Social Media', 'Referral', 'Advertisement'];
        // $sources = Lead::pluck('source');

        // $services = LeadsMaster::where('type', 'service')->pluck('name');
        // $sources  = LeadsMaster::where('type', 'source')->pluck('name');
        // $statuses = LeadsMaster::where('type', 'status')->pluck('name');

      // Sirf Active Services, Sources, Status Fetch Karna (Without Color)
        $services = LeadsMaster::where('type', 'service')->where('status', 1)->pluck('name');
        $sources  = LeadsMaster::where('type', 'source')->where('status', 1)->pluck('name');
        $statuses = LeadsMaster::where('type', 'status')->where('status', 1)->pluck('name');
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
        // $assignees = ['Swati', 'Mohit', 'Aakriti', 'Vikash', 'Hemendra'];
        $assignees = DB::table('admins')->pluck('name');
        $services = LeadsMaster::where('type', 'service')->where('status', 1)->pluck('name');
        $sources  = LeadsMaster::where('type', 'source')->where('status', 1)->pluck('name');
        $statuses = LeadsMaster::where('type', 'status')->where('status', 1)->pluck('name');



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
    // index/ eye
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




        // index /pencil
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
    //   dd('delete method working',$id);

       $lead= Lead::findOrFail($id);
       $lead->delete();
       return redirect()->back()->with('success','deleted successfully');
    }



    public function history(string$id){
        // dd(DB::table('lead_histories')->get());

       // dd($id);

    //    $leadhistorys= LeadHistory::findOrFail($id);
       $leadhistorys= LeadHistory::where('lead_id',$id)->get();

//dd($leadhistorys);

       return view('lead.history',compact('leadhistorys'));

    }





    //filter
    public function filterLeads(Request $request)
{
    $dateFilter = $request->query('date');
    $query = Lead::query();

    switch ($dateFilter) {
        case 'today':

            $query->whereDate('created_at', Carbon::now());
            // dd('create_at');
            break;
        case 'last30days':
            $query->where('created_at', '>=', Carbon::now()->subDays(30));
            break;
        case 'last90days':
            $query->where('created_at', '>=', Carbon::now()->subDays(90));
            break;
        case 'last6months':
            $query->where('created_at', '>=', Carbon::now()->subMonths(6));
            break;
        case 'lastmonth':
            $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                  ->whereYear('created_at', Carbon::now()->year);
            break;
        case 'thismonth':
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
            break;
        case 'lastyear':
            $query->whereYear('created_at', Carbon::now()->subYear()->year);
            break;
    }

    $leads = $query->get();

    return response()->json($leads);
}
}

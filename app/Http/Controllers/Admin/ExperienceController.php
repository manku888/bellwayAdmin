<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences=Experience::all();
        // dd($experiences);
        foreach ($experiences as $experience) {
            // Assuming 'created_at' is the datetime column in the 'contacts' table
              $experience->date = $experience->created_at->format('d-m-Y');  // Format the date
              $experience->time = $experience->created_at->format('H:i:s');  // Format the time
           }
        return view('admin.experience.index',compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:experiences',
        'phone_no' => 'required|string|max:15',
        'current_location' => 'required|string',
        'current_ctc' => 'nullable|numeric|min:0',
        'notice_period' => 'required|string|max:50',
        'total_experience' => 'required|string|max:50',
        'resume_link' => 'required|url',
        'selected_role' => 'nullable|in:Developer,Tester,Manager,Designer,Other',
    ]);

    // Save the validated data
    Experience::create($validated);

    return response()->json(['message' => 'Experience details stored successfully'], 201);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $exprience= Experience::findOrFail($id);
       $exprience->delete();

       return redirect()->back()->with('success', 'exprience data deleted successfully!');
    }
}

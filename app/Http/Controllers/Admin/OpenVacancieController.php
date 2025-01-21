<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpenVacancy;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OpenVacancieController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {

        return[
           new Middleware('permission:view openvacancie', only: ['index']),
        //    new Middleware('permission:create openvacancie', only: ['create']),
           new Middleware('permission:delete openvacancie', only:['destroy'] ),
       ];
    }
    public function index()
    {
       $openvacancies =OpenVacancy::paginate(10);
       foreach ($openvacancies as $openvacancie) {
        // Assuming 'created_at' is the datetime column in the 'contacts' table
          $openvacancie->date = $openvacancie->created_at->format('d-m-Y');  // Format the date
          $openvacancie->time = $openvacancie->created_at->format('H:i:s');  // Format the time
       }
        return view('admin.vacancies.openvacancie.index',compact('openvacancies'));
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
            'phone_no' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'service' => 'required|in:Developer,Tester,Manager,Designer,Other',
            'resume_link' => 'required|string',
            'message' => 'nullable|string',
        ]);

        OpenVacancy::create($validated);

        return response()->json(['message' => 'Open vacancy application stored successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
        $opv =OpenVacancy::findOrFail($id);
        $opv->delete();

        return redirect()->back()->with('success','openvacancie data delete successfully');
    }
}

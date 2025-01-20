<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fresher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FresherController extends Controller implements HasMiddleware
{

    public static function middleware() : array
    {

        return[
           new Middleware('permission:view freshers', only: ['index']),
           new Middleware('permission:delete freshers', only:['destroy'] ),
       ];
    }



    public function index()
    {
       $fresherdatas = Fresher::all();

       foreach ($fresherdatas as $fresherdata) {
        // Assuming 'created_at' is the datetime column in the 'contacts' table
          $fresherdata->date = $fresherdata->created_at->format('d-m-Y');  // Format the date
          $fresherdata->time = $fresherdata->created_at->format('H:i:s');  // Format the time
       }
        return view('admin.fresher.index',compact('fresherdatas'));
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
          $validated= $request->validate(
        [
           'name'=>'required|string|max:255',
           'email'=>'required|string|max:255|unique:freshers',
           'phone_no'=>'required|max:15',
           'resume' => 'required|string',
            'cover_letter' => 'required|string',
        ]);

     Fresher::create($validated);

     return response()->json(['message'=>'Fresher request store successfully']);
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
        $fresher = Fresher::findOrFail($id);
        $fresher->delete();

        return redirect()->back()->with('success', 'fresher data deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hiring;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HiringController extends Controller implements HasMiddleware
{

    public static function middleware() : array
    {

        return[
           new Middleware('permission:View Hiring', only: ['index']),
           new Middleware('permission:Create Hiring', only: ['create']),
           new Middleware('permission:delete hiring', only:['destroy'] ),
       ];
    }


    // get data and show in dashboard
    public function index(){
     $hirings = Hiring::paginate(10);
    // dd('asdfghjkert');
    foreach ($hirings as $hiring) {
        // Assuming 'created_at' is the datetime column in the 'contacts' table
          $hiring->date = $hiring->created_at->format('d-m-Y');  // Format the date
          $hiring->time = $hiring->created_at->format('H:i:s');  // Format the time
       }
       return view('admin.hiring.index',compact('hirings'));
    }


   public function create(){
    return view('admin.hiring.create');
   }

   public function store(Request $request){




    $request->validate([
            'position'=>'required|string|max:255',
            'experience'=>'required|string|min:1|max:50',
        ]);
        // dd($request->all());
    Hiring::create([
      'positions'=>  $request->position,
      'experience'=> $request->experience,
    ]);

    return redirect()->back()->with('success', 'Hiring data saved successfully!');
   }

//    edit
//    public function edit($id)
// {
//     $hiring = Hiring::findOrFail($id);
//     //dd($hiring);
//     return view('admin.hiring.edit', compact('hiring'));
// }




   // delete
   public function destroy($id)
{
    //dd($id);
    $hiring = Hiring::findOrFail($id);
    $hiring->delete();

    return redirect()->back()->with('success', 'Hiring data deleted successfully!');
}



   // Get all hirings using API
   public function getAll()
   {
       return response()->json(Hiring::all());
   }
}

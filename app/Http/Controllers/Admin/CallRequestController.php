<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CallRequestController extends Controller implements HasMiddleware
{


    public static function middleware() : array
    {

        return[
           new Middleware('permission:View Call Requests Queries', only: ['index']),
           new Middleware('permission:Delete Call Request Queries', only:['destroy'] ),
       ];
    }

    public function index(){

          $calldatas= CallRequest::paginate(10);
        //   dd($calldatas);

        return view('admin.call.index ',compact('calldatas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'message' => 'nullable|string',
        ]);

        CallRequest::create($validated);

        return response()->json(['message' => 'Call request stored successfully'], 201);
    }


    public function destroy($id)
    {
        $call = CallRequest::findOrFail($id);
        $call->delete();

        return redirect()->back()->with('success', 'CallRequest data deleted successfully!');
    }


}


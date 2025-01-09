<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallRequest;
use Illuminate\Http\Request;

class CallRequestController extends Controller{

    public function index(){

          $calldatas= CallRequest::all();
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


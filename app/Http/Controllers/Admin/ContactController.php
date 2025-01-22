<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ContactController extends Controller implements HasMiddleware
{
         public static function middleware() : array
         {

             return[
                // new Middleware('permission:Queries',['index']),
                new Middleware('permission:view contact', only: ['index']),
                new Middleware('permission:delete contact', only:['destroy'] ),
            ];
         }



    public function index()
    {

        $contacts = Contact::paginate(10);
        // Iterate through each contact and extract date and time separately
       foreach ($contacts as $contact) {
        // Assuming 'created_at' is the datetime column in the 'contacts' table
          $contact->date = $contact->created_at->format('d-m-Y');  // Format the date
          $contact->time = $contact->created_at->format('H:i:s');  // Format the time
       }
        //  dd($contacts);
        return view('admin.contact.index', compact('contacts'));
        // return response()->json($contacts);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_no' => 'required|string|max:15',
            'service_of_interest' => 'required|array',
            'message' => 'nullable|string',
        ]);

        Contact::create($validated);

        return response()->json(['message' => 'Contact stored successfully'], 201);


    }


    // public function create()
    // {
    //     // return view('admin.contact.create');
    // }

    // public function edit($id)
    // {
    //     // $contact = Contact::findOrFail($id);
    //     // return view('admin.contact.edit', compact('contact'));
    // }

    // public function update(Request $request, $id)
    // {
    //     // $validated = $request->validate([
    //     //     'full_name' => 'required|string|max:255',
    //     //     'city' => 'required|string|max:255',
    //     //     'phone_no' => 'required|string|max:15',
    //     //     'service_of_interest' => 'required|array',
    //     //     'message' => 'nullable|string',
    //     // ]);

    //     // $contact = Contact::findOrFail($id);
    //     // $contact->update($validated);

    //     // return redirect()->route('contact.index')->with('success', 'Contact updated successfully!');
    // }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully!');
    }
}

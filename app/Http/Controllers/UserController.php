<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\get;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {

        return[
           new Middleware('permission:View User', only: ['index']),
           new Middleware('permission:Create User', only: ['create']),
           new Middleware('permission:Edit User', only: ['edit']),
            new Middleware('permission:Delete User', only:['destroy'] ),
       ];
    }
    // fatch all admins in user controller
    public function index()
    {
        $users = Admin::latest()->paginate(10);
        return view('user.list',['users'=> $users ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name','ASC')->get();
        return view('user.create',[
            'roles'=> $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(),[
           'name'=> 'required|min:3',
           'bg_color' => 'nullable|string',
           'email'=> 'required|email|unique:admins,email',
           'password'=>'required|min:8|same:confirm_password',
           'confirm_password'=>'required'

        ]);

        if ($validator->fails()) {
           return redirect()->route('user.create')->withInput()->withErrors($validator);
        }

        $users = new Admin();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->bg_color = $request->bg_color;

        $users->save();

        $users->syncRoles($request->role);

        return redirect()->route('user.index')->with('success','user created successfully');


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

        $users = Admin::findOrFail($id);
        $roles = Role::orderBy('name','ASC')->get();

        // check which role assignee of user
        $hasRoles = $users->roles->pluck('id');
        // dd($hasRole);
        return view('user.edit',
  [
            'users'=> $users,
            'roles' => $roles,
            'hasRoles'=>$hasRoles,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = Admin::findOrFail($id);
         $validator = Validator::make($request->all(),[
            'name'=> 'required|min:3',
            'email'=> 'required|email|unique:admins,email,'.$id.'id',
            'bg_color' => 'nullable|string',
            'password' => 'nullable|min:8|same:confirm_password', // Password is optional
            'confirm_password' => 'nullable', // Confirm password is optional
         ]);

         if ($validator->fails()) {
            return redirect()->route('user.edit',$id)->withInput()->withErrors($validator);
         }

         $users->name = $request->name;
         $users->email = $request->email;
         $users->bg_color = $request->bg_color;

          // Update password if provided
    if ($request->filled('password')) {
        $users->password = Hash::make($request->password); // Hash the new password
    }
         $users->save();

         $users->syncRoles($request->role);

         return redirect()->route('user.index')->with('success','user updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $user =Admin::findOrFail($id);
      $user->delete();

      return redirect()->back()->with('success','User deleted Successfully');

    }
}

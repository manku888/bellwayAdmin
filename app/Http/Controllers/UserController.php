<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use function Pest\Laravel\get;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {

        return[
           new Middleware('permission:view user', only: ['index']),
        //    new Middleware('permission:create user', only: ['create']),
           new Middleware('permission:edit user', only: ['edit']),
            new Middleware('permission:delete user', only:['destroy'] ),
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
         ]);

         if ($validator->fails()) {
            return redirect()->route('user.edit',$id)->withInput()->withErrors($validator);
         }

         $users->name = $request->name;
         $users->email = $request->email;

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

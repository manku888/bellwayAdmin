<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{


    public static function middleware() : array
    {

        return[

           new Middleware('permission:view role', only: ['index']),
           new Middleware('permission:create role', only: ['store']),
           new Middleware('permission:edit role', only: ['edit']),
           new Middleware('permission:delete role', only:['destroy'] ),
       ];
    }

    //this method will show roles page
    public function index(){
    //  dd('index');
    $roles = Role::orderBy('name','ASC')->paginate(10);
     return view('role.list',['roles' => $roles]);
    }
    // this method will show create role page
    public function create(){

        $permissions = Permission::orderBy('name','ASC')->get();
        return view('role.create',[ 'permissions' => $permissions]
     );
    }
    //create/insert role in db
    public function store(Request $request){

    // dd('permission bn gya hai  role se bnan hai ');


    $validate= Validator::make( $request->all(),
    [
        "name"=> 'required|max:25|unique:roles|min:2',
    ]
    );
    if ($validate->passes()) {

        // dd($request);
          $role = Role::create(['name'=>$request->name,'guard_name' => 'admin', ]);

        if (!empty($request->permission)) {
          foreach ($request->permission as  $name) {
              $role->givePermissionTo($name);
          }
        }



        return redirect()->route('role.index')->with('success','Role assign Successfully');
    }
    else{
        // return redirect()->back()->with('error','validation is fail data is not inserted in database');
        return redirect()->route('role.create')->withInput()->withErrors($validate);
    };



    }
    //baad m
    public function show($id){

    }

    public function edit($id){

       $roles = Role::findOrFail($id);
       $haspermissions = $roles->permissions->pluck('name');
       $permissions = Permission::orderBy('name','ASC')->get();

       //dd($haspermissions);
       return view('role.edit',[
        "permissions" => $permissions,
        "haspermissions" => $haspermissions,
         "roles" => $roles,
       ]);
    }
    public function update(Request $request, $id){

    $role = Role::findOrFail($id);


    // for name update
    $validate= Validator::make( $request->all(),
    [
        'name'=> 'required|max:25|unique:roles,name,'.$id.',id',
    ]
    );


    if ($validate->passes()) {

        // dd($request);
        //   $role = Role::create(['name'=>$request->name]);

        $role->name = $request->name;

        $role->save();

        if (!empty($request->permission)) {

            // permistion ko sync krke upate krne ke liye
            $role->syncPermissions($request->permission);
        } else{
            //  agr permition nhi hai to array mai blank p.. save hoga
            $role->syncPermissions([]);
        }



        return redirect()->route('role.index')->with('success','Role updated Successfully');
    }
    else{
        // return redirect()->back()->with('error','validation is fail data is not inserted in database');
        return redirect()->route('role.edit',$id)->withInput()->withErrors($validate);
    };

    }
    public function destroy($id){

        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success','role deleted Successfully');
    }

}

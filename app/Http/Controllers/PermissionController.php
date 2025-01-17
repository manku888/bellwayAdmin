<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{
    // this method is show permissions
    public function index(){

       $permissions = Permission::orderBy('created_at','desc')->paginate(10);
        return view('permissions.list' ,compact('permissions'));
        // // dd($permissions);
        // $permissions = Permission::all();
        // return view('permissions.create' ,compact('permissions'));
    }

    // this method is create permissions
    public function create(){

        return view('permissions.create');
    }


    // this method is store permissions
    public function store(Request $request){

        $validate= Validator::make( $request->all(),
            [
                "name"=> 'required|max:25|unique:permissions',

            ]
            );
            if ($validate->passes()) {
                Permission::create(['name'=>$request->name]);
                return redirect()->route('permissions.index')->with('success','Permission Added Successfully');
            }
            else{
                // return redirect()->back()->with('error','validation is fail data is not inserted in database');
                return redirect()->route('permissions.create')->withInput()->withErrors($validate);
            };




    }
    // this method is edit permissions
    public function edit($id){

       $permission = Permission::findOrFail($id);

       return view('permissions.edit',compact('permission'));

    }
    // this method is update permissions
    public function update($id, Request $request){

        $permission = Permission::findOrFail( $id);
        $validator = Validator::make($request->all(),
            ['name'=>'required|min:3|unique:permissions,name,'.$id]);//'.$id.',id" error
            if($validator->passes()){
              $permission->name = $request->name;
              $permission->save();

              return redirect()->route('permissions.index')->with('success','Permission updated successfully.');
            }else{
                return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
            }
    }
    // this method is destroy permissions
    public function destroy($id){


        // dd($id);
        $permission=Permission::findOrFail( $id);

        $permission->delete();

        return redirect()->back()->with('success','deleted successfully');
    }

}

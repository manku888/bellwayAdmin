<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadsMaster;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LeadsMasterController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {

        return [
            new Middleware('permission:View Lead master', only: ['index']),
            new Middleware('permission:create lead master', only: ['create', 'store']),
            //    new Middleware('permission:edit permission', only: ['edit']),
            new Middleware('permission:delete Lead master list', only: ['destroy']),
        ];
    }


    public function index($type)
    {
        $items = LeadsMaster::where('type', $type)->get();
        return view("leads_master.$type", compact('items', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required|unique:leads_master,name',
            'bg_color' => 'required',
        ]);

        LeadsMaster::create($request->all());

        return back()->with('success', ucfirst($request->type) . ' added successfully.');
    }

    public function toggleStatus($id)
    {
        $item = LeadsMaster::findOrFail($id);
        $item->status = !$item->status;
        $item->save();

        return back();
    }

    public function destroy($id)
    {
        LeadsMaster::findOrFail($id)->delete();
        return back()->with('success', 'Deleted successfully.');
    }
}

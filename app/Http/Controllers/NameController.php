<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Illuminate\Http\Request;

class NameController extends Controller
{
    public function index()
    {
        return view('welcome',['names' => Name::orderBy('id','desc')->get()]);
    }
    public function edit(Name $name)
    {
        return response()->json($name);
    }
    public function store(Request $request)
    {
        $name = Name::updateOrCreate(
            ['id' =>$request->id],
            ['name' =>$request->name]
            );
        return response()->json($name);
    }
    public function destroy(Name $name)
    {
        $name->delete();
        return response()->json('Successfully Deleted');
    }
}

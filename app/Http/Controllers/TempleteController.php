<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class TempleteController extends Controller
{
    public function starter()
    {
        return view('templete.starter');
    }
    public function index()
    {
        $result = CategoryService::getAllData();
        // return view('templete.index',compact('result'));
        return response()->json($result);
    }
    public function store(CategoryRequest $request)
    {
        $request->validated();
        $category = CategoryService::storeData($request);
        return redirect('/index');
    }
}

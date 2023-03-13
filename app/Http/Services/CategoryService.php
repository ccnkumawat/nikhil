<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{

    public static function getAllData()
    {
        $category = Category::orderBy('id','DESC')->get();
        return $category;
    }
    /**
     *
     *@param  int  $id
     *
     */
    public static function findData(int $id)
    {
        // $chapters = Chapter::findOrFail($id);
        // return $chapters;
    }
    public static function storeData($request, $id = '')
    {
        try {
            if ($id == "") {

                $category = new Category();
                $category->category = $request->category;
                $category->save();

            } else {

                // $company = Company::find($id);
                // $company->save();
            }
            $result = ['status' => 200, 'message' => $category];
        } catch (\Throwable $th) {
            $result = ['status' => 500, 'message' => $th->getMessage()];
        }
        return $result;
    }
}

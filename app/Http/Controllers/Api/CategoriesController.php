<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\RealWorld\Paginate\Paginate;
use App\Category;
use DB;

class CategoriesController extends ApiController
{
    /*public function __construct()
    {
        $this->middleware('auth.api')->except(['index', 'show']);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('categories.create',compact('categories'));
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $string = "";
            foreach ($validator->errors()->getMessages() as $item) {
                $string .= "{$item[0]}<br>";
            }
            return back()->withErrors($validator)->withInput();
        } else {
            $category = new Category;
            $category->name = $request->name;
            $category->parent_category_id = $request->parent_category;
            $category->save();
            return $this->sendResponse($category->toArray(), 'Category created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('categories.edit', compact('category','categories'));
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $string = "";
            foreach ($validator->errors()->getMessages() as $item) {
                $string .= "{$item[0]}<br>";
            }
            return back()->withErrors($validator)->withInput();
        } else {
            $category = Category::findOrFail($id);
            $input = $request->all();
            $category->update($input);
            return $this->sendResponse($category->toArray(), 'Category updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->sendResponse($id, 'Category deleted successfully.');
    }
}

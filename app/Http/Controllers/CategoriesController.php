<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;
use DB;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->latest()->paginate(5);
        $parent_categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('categories.index',compact('categories','parent_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('categories.create',compact('categories'));
    }

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
            return redirect('categories')->with('success', 'Category updated successfully.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('categories.edit', compact('category','categories'));
    }

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
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
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
        return redirect()->route('categories.index')->with('success', 'category has been deactivated');
    }

    public function restore($id) {

        $category = Category::withTrashed()->find($id)->restore();
        return redirect()->route('categories.index');
    }
}

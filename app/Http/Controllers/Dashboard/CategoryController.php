<?php

namespace App\Http\Controllers\DAshboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['categories'] = Category::when($request->search, function($query) use ($request){
          return  $query->where('name' , 'like','%' . $request->search . '%');
        })->latest()->paginate(10);

       // $data['categories'] = Category::paginate(10);
        return view('dashboard.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       // return $request;
        Category::create([
            'name' => $request->name,
        ]);

        toastr()->success('تمت ألإضافة بنجاح');
        return redirect()->route('categories.index');
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
        $data['category'] = Category::find($id);
        return view('dashboard.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request)
    {
       // return $request;
       // $data = $request->except(['_token']);
        $category = Category::find($request->id);
        $category->update($request->all());

        toastr()->success('تم التحديث بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();

        toastr()->info('تم الحذف بنجاح');
        return redirect()->route('categories.index');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:products_create'])->only('create');
        $this->middleware(['permission:products_read'])->only('index');
        $this->middleware(['permission:products_update'])->only('edit');
        $this->middleware(['permission:products_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['products'] = Product::when($request->search,function($query) use ($request){
           return $query->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(10);

      //  $data['products'] = Product::all();
        return view('dashboard.products.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('dashboard.products.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
       // return $request;
        DB::beginTransaction();
            $data = $request->except(['_token']);

            if($request->image){

              //  dd(Image::make($request->image));
                Image::make($request->image)->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product_images/' . $request->image->hashName() ));

                $data['image'] = $request->image->hashName();
            }

            Product::create($data);

        DB::commit();
            toastr()->success('تمت الإضافة بنجاح');
            return redirect()->route('products.index');

        DB::rollBack();
            toastr()->error('حدث خطأ ما حاول مرة اخري في وقت لاحق');
            return redirect()->route('products.index');

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
        $data['product'] = Product::find($id);
        $data['categories'] = Category::all();
        return view('dashboard.products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        DB::beginTransaction();
            $product = Product::find($request->id);
            $data = $request->except(['_token']);

           if($request->image){
               if($product->image != 'product.png'){
                   storage::disk('public_uploads')->delete('/product_images/'. $product->image);
               }  //delete image old

               Image::make($request->image)->resize(null, 200, function ($constraint) {
                   $constraint->aspectRatio();
               })->save(public_path('uploads/product_images/' . $request->image->hashName() ));

               $data['image'] = $request->image->hashName();
           } // end of if

            $product->update($data);
       DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('products.index');

       DB::rollBack();
            toastr()->error('حدث خطأ ما حاول مرة اخري في وقت لاحق');
            return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $product = Product::find($request->id);

        if($product->image != 'product.png'){
            storage::disk('public_uploads')->delete('/product_images/'.$product->image);
        }
        $product->delete();
        toastr()->info('تم الجذف بنجاح');
        return redirect()->route('products.index');



    }
}

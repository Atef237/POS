@extends('dashboard.includes.empty')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>اضافة قسم</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">ألأقسام</a> </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> اضافة قسم </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('products.update','update')}}" method="post"  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf


                                <div class="card-body">

                                    <input type="hidden" value="{{$product->id}}" name="id">
                                    <div class="form-group">
                                        <label>الاقسام</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">كل الاقسام</option>
                                            {{--                                            <optgroup label="كل الاقسام"></optgroup>--}}
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{ $category->id == $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                        @error("category_id")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم</label>
                                        <input type="text" value="{{$product->name}}" name="name"  class="form-control" id="exampleInputEmail1" placeholder="الاسم ">

                                        @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الوصف</label>
                                        {{--                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="الاسم ">--}}
                                        <textarea name="description" class="form-control ckeditor"  placeholder="الوصف ">{{$product->description}}</textarea>

                                        @error("description")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>سعر الشراء</label>
                                        <input name="purchase_price" value="{{$product->purchase_price}}" class="form-control">
                                        @error("purchase_price")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>سعر البيع</label>
                                        <input name="sale_price" value="{{$product->sale_price}}" class="form-control">
                                        @error("sale_price")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المخزون</label>
                                        <input name="stock" value="{{$product->stock}}" class="form-control">
                                        @error("stock")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">اختر صورة</label>
                                        <input type="file" name="image"  class="form-control image" id="exampleInputPassword1" placeholder="البريد الإلكتروني">
                                        @error("image")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <img src="{{$product->image_path}}" style="width: 100px" class="image-preview img-thumbnail">

                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">تحديث</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>


@endsection

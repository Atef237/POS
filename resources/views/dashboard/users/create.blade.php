@extends('dashboard.includes.empty')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>المشرفين</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">المشرفين</li>
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
                                <h3 class="card-title"> اضافة مشرف جديد </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم الأول</label>
                                        <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" id="exampleInputEmail1" placeholder="الاسم الأول">

                                        @error("first_name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">الاسم الثاني</label>
                                        <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" id="exampleInputPassword1" placeholder="الاسم الثاني">

                                        @error("last_name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">البريد الإلكتروني</label>
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputPassword1" placeholder="البريد الإلكتروني">
                                        @error("email")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">كلمة المرور</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="يجب ان لا تقل كلمة المرور 5 احرف">

                                        @error("password")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">تأكيد كلمة المرور</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="يجب ان لا تقل كلمة المرور 5 احرف">
                                        @error("password_confirmation")
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
                                        <img src="{{asset('uploads/user_images/client.png')}}" style="width: 100px" class="image-preview img-thumbnail">

                                    </div>

                                    <div class="form-group">
                                        <label> الصلاحيات </label>


                                        @php

                                        $models = ['users','categories','products'];
                                        $maps = ['create','read','update','delete'];

                                        @endphp


                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Custom Tabs -->
                                                <div class="card">
                                                    <div class="card-header d-flex p-0">
                                                        <ul class="nav nav-pills ml-auto p-2">
                                                            @foreach($models as $index=>$model)
                                                                <li class="nav-item"><a class="nav-link {{$index == 0 ? 'active' : '' }}" href="#{{$model}}" data-toggle="tab">{{$model}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div><!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="tab-content">
                                                            @foreach($models as $index=>$model)
                                                                <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">

                                                                @foreach($maps as $map)
                                                                    <label><input type="checkbox" name="permissions[]" value="{{ $model .'_'. $map }}">{{$map}}</label>
                                                                @endforeach

                                                            </div>
                                                            @endforeach
                                                                @error("permissions")
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                            <!-- /.tab-pane -->
                                                        </div>
                                                        <!-- /.tab-content -->
                                                    </div><!-- /.card-body -->
                                                </div>
                                                <!-- ./card -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>




                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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

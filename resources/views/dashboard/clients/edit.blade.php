@extends('dashboard.includes.empty')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>العملاء</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">العملاء</li>
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
                                <h3 class="card-title"> اضافة عميل جديد </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="{{route('clients.update','update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{$client->id}}">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم</label>
                                        <input type="text" name="name" value="{{$client->name}}" class="form-control" id="exampleInputEmail1" placeholder="الاسم ......">

                                        @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                    @foreach($client->phone as $phone)
                                        <div class="form-group">
                                        <label for="exampleInputPassword1">رقم الهاتف</label>
                                        <input type="text" name="phone[]" value="{{$phone}}"  class="form-control" id="exampleInputPassword1" placeholder="رقم الهاتف">

                                        @error("phone")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                    @endforeach




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">العنوان</label>
                                        <textarea name="address" class="form-control"  placeholder="العنوان ">{{$client->address}}</textarea>

                                        @error("address")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">اختر صورة</label>
                                        <input type="file" name="image"  class="form-control image" id="exampleInputPassword1">
                                        @error("image")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <img src="{{$client->image_path}}" style="width: 100px" class="image-preview img-thumbnail">

                                    </div>

                                    {{--                                    <div class="form-group">--}}
                                    {{--                                        <label> الصلاحيات </label>--}}


                                    {{--                                        @php--}}

                                    {{--                                            $models = ['users','categories','products'];--}}
                                    {{--                                            $maps = ['create','read','update','delete'];--}}

                                    {{--                                        @endphp--}}


                                    {{--                                        <div class="row">--}}
                                    {{--                                            <div class="col-12">--}}
                                    {{--                                                <!-- Custom Tabs -->--}}
                                    {{--                                                <div class="card">--}}
                                    {{--                                                    <div class="card-header d-flex p-0">--}}
                                    {{--                                                        <ul class="nav nav-pills ml-auto p-2">--}}
                                    {{--                                                            @foreach($models as $index=>$model)--}}
                                    {{--                                                                <li class="nav-item"><a class="nav-link {{$index == 0 ? 'active' : '' }}" href="#{{$model}}" data-toggle="tab">{{$model}}</a></li>--}}
                                    {{--                                                            @endforeach--}}
                                    {{--                                                        </ul>--}}
                                    {{--                                                    </div><!-- /.card-header -->--}}
                                    {{--                                                    <div class="card-body">--}}
                                    {{--                                                        <div class="tab-content">--}}
                                    {{--                                                            @foreach($models as $index=>$model)--}}
                                    {{--                                                                <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">--}}

                                    {{--                                                                    @foreach($maps as $map)--}}
                                    {{--                                                                        <label><input type="checkbox" name="permissions[]" value="{{ $model .'_'. $map }}">{{$map}}</label>--}}
                                    {{--                                                                    @endforeach--}}

                                    {{--                                                                </div>--}}
                                    {{--                                                            @endforeach--}}
                                    {{--                                                            @error("permissions")--}}
                                    {{--                                                            <span class="text-danger">{{$message}}</span>--}}
                                    {{--                                                        @enderror--}}
                                    {{--                                                        <!-- /.tab-pane -->--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                        <!-- /.tab-content -->--}}
                                    {{--                                                    </div><!-- /.card-body -->--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <!-- ./card -->--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <!-- /.col -->--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}




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

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
                            <form action="{{route('categories.store')}}" method="post" >
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم</label>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="الاسم ">

                                        @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">اضافة</button>
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

@extends('dashboard.includes.empty')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>الاقسام <small>{{$categories->total()}}</small></h1>


                        @if(auth()->user()->hasPermission('categories_create'))
                            <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> اضافة</a>
                        @else
                            <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus"></i> اضافة</a>
                        @endif

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">الاقسام</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if(count($categories) > 0)
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">الاقسام</h3>



                                    <form action="{{route('categories.index')}}" method="get">
                                        @csrf

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{request()->search}}">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>

                                                    {{--                                                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> بحث</button>--}}

                                                </div>
                                            </div>
                                        </div>

                                    </form>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>

                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $index=>$category)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$category->name}}</td>

                                                <td>

                                                    @if(auth()->user()->hasPermission('categories_update'))
                                                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> تعديل </a>
                                                    @else
                                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> تعديل </a>

                                                    @endif

                                                    @if(auth()->user()->hasPermission('categories_delete'))



                                                    <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="fa fa-trash"></i>
                                                            حذف
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('categories.destroy','delete')}}" method="post" style="display:inline">
                                                                            @csrf
                                                                            @method('DELETE')

                                                                            <input type="hidden" name="id" value="{{$category->id}}">



                                                                            هل تريد الحذف {{$category->first_name . ' '. $category->last_name}}

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء </button>
                                                                        {{--                                                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>

                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    @else
                                                        <button type="submit" class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> حذف</button>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                {{$categories->appends(request()->query())->links()}}    <!-- to append request field search to other pages  -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>

        @else
            <h1> لا يوجد بيانات </h1>
        @endif


    </div>



@endsection

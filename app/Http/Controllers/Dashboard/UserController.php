<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;



class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');

    }//end of constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        ///////////////////////////////   bad query  ///////////////////////////

//       if($request->search){
//           $data['users'] = User::whereRoleIs('admin')->where('first_name','like','%'.$request->search.'%')
//               ->Orwhere('last_name','like','%'.$request->search.'%')
//               ->get();
//       }else{
//           $data['users'] = User::whereRoleIs('admin')->get();
//       }



        //////////////////////////////  The best search query  //////////////////////////////////////////////

        $data['users'] = User::WhereRoleIs('admin')->where(function ($q) use ($request){
           return  $q->when($request->search, function ($query) use ($request){

                return $query->where('first_name','like','%'.$request->search.'%')
                    ->Orwhere('last_name','like','%'.$request->search.'%');
            });
        })->latest()->paginate(10);


        return view('dashboard.users.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

       // return $request;
        $data = $request->except(['password','password_confirmation','permissions','image']);
        $data['password'] = bcrypt($request->password);

        if($request->image){

            Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName() ));

            $data['image'] = $request->image->hashName();
        }
        $user = User::create($data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        toastr()->success('تمت ألإضافة بنجاح');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return "Edit" . $id;
        $data['user'] = User::find($id);

        return view('dashboard.users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
       // return $request;
        $user = User::find($request->id);
        $data = $request->except(['permissions','image']);

        if($request->image){

            if($user->image != 'client.png'){
                storage::disk('public_uploads')->delete('/user_images/'. $user->image);
            }  //delete image old

            Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName() ));

            $data['image'] = $request->image->hashName();
        }

        $user->update($data);
        $user->syncPermissions($request->permissions);


        toastr()->success('تمت التحديث بنجاح');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request;


       $user = User::find($request->id);
       if($user->image != 'client.png'){
           storage::disk('public_uploads')->delete('/user_images/'. $user->image);
       }
       $user->delete();
        toastr()->info('تم الحذف بنجاح');
        return redirect()->route('users.index');
    }
}

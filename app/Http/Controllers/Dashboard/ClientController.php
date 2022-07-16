<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['clients'] = Client::when($request->search,function ($query) use($request){
            return $query->where('name','like','%'.$request->search.'%')
                ->OrWhere('address','like','%'.$request->search.'%')
                ->OrWhere('phone','like','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('dashboard.clients.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        // return $request;

        $data = $request->except(['image']);
        $data['phone'] = array_filter($request->phone);

       // return $data;

        if($request->image){

            Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/client_images/' . $request->image->hashName() ));

            $data['image'] = $request->image->hashName();
        }
        $user = Client::create($data);


        toastr()->success('تمت ألإضافة بنجاح');
        return redirect()->route('clients.index');

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
         $data['client'] = Client::find($id);
        return view('dashboard.clients.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request)
    {
      //  return $request;
        $data = $request->except('_token','image');

        $client = Client::find($request->id);

        if($request->image){
            if($client->image != 'client.png'){
                storage::disk('public_uploads')->delete('/client_images/'. $client->image);
            }

            Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/client_images/' . $request->image->hashName() ));

            $data['image'] = $request->image->hashName();

        }
        $client->update($data);
        toastr()->success('تم التعديل بنجاح');
        return redirect()->route('clients.index');
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
        $client = Client::find($request->id);

        if($client->image != 'client.png'){
            storage::disk('public_uploads')->delete('/client_images/'. $client->image);
        }

        $client->delete();
        toastr()->info('تم الحذف بنجاح');
        return redirect()->route('clients.index');

    }
}

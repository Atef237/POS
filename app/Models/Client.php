<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $appends = ['image_path'];

    protected $casts = [
        'phone' => 'array'
    ];


    public function getImagePathAttribute(){
        return asset('uploads/client_images/'.$this->image);
    }
}

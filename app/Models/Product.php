<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['image_path','profit_percent'];

    public function getImagePathAttribute(){
        return asset('uploads/product_images/'.$this->image);
    }

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function getProfitPercentAttribute(){
        $profit = $this->sale_price  - $this->purchase_price;

        $profit_percent = $profit * 100 / $this->purchase_price;

        return number_format($profit_percent,2);
    }
}

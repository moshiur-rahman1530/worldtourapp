<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['cat_name', 'cat_img', 'cat_des','img_name', 'status'];

    public $table='categories';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=true;
}

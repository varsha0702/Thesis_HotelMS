<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff_review extends Model
{
    protected $table = 'staff_reviews';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
        'c_id',
        's_id',
        'review'
    ];
    public $timestamps = false;
}

<?php

namespace App;
use Carbon\Carbon; 

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personals';

    protected $fillable = ['fullname', 'gender','birthday','phone', 'email', 'country', 'hobbies', 'nickname'];
    
    public $timestamps = false;

    public static function toDateTime($value){
       return Carbon::createFromFormat('d/m/Y', $value);
    }
}

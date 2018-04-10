<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    public $table = 'instructors';
    protected $fillable = ['fullname', 'gender','birthday','phone', 'email', 'address'];
    public $timestamps = false;

    public function subjects()
    {
        return $this->belongsToMany("App\Subject", "instructor_subjects");
    }

    public static function toDateTime($value){
        return Carbon::createFromFormat('d/m/Y', $value);
     }
}

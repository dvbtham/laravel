<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['fullname', 'gender','birthday','phone', 'email', 'country', 'hobbies', 'nickname', "class_id"];
    
    public $timestamps = false;
    protected $primaryKey = 'id';

    public static function toDateTime($value){
       return Carbon::createFromFormat('d/m/Y', $value);
    }

    /**
     * Get the class that owns the student.
    **/
    public function class()
    {
        return $this->belongsTo('App\mClass','class_id', 'id');
    }
}

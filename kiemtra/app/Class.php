<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mClass extends Model
{
    protected $table = 'classes';
    protected $fillable = ["class_name"];
    public $timestamps = false;
    protected $primaryKey = 'id';

     /**
     * Get the students for the class.
     */
    public function students()
    {
        return $this->hasMany('App\Student', 'class_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department','department_id', 'id');
    }
}

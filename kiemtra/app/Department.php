<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    protected $fillable = ["name"];
    public $timestamps = false;

    public function classes()
    {
        return $this->hasMany('App\Class', 'department_id');
    }

    public function students()
    {
        return $this->hasManyThrough(
            'App\Student',
            'App\mClass',
            'department_id', // Foreign key on classes table...
            'class_id', // Foreign key on students table...
            'id', // Local key on departments table...
            'id' // Local key on classes table...
        );
    }
}

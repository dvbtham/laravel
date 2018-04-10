<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subjects";
    protected $fillable = ["title", "credit"];
    public $timestamps = false;

    public function instructors()
    {
        return $this->belongsToMany("App\Instructor", "instructor_subjects");
    }
}

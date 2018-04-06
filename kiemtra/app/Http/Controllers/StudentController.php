<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\StudentFormRequest;
use App\Http\Requests\StudentEditFormRequest;
use App\Student;
use App\mClass;
use Carbon\Carbon;
use Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Student::with("class")->paginate(10);
        return view("personal.index")-> withPeople($people);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = mClass::pluck("class_name", "id");
        $classes->prepend('-- Chọn lớp --', '');
        return view('personal.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentFormRequest $request)
    {
        $person = new Student(array
        (
            'fullname' => $request -> fullname,
            'gender' => $request -> gender,
            'birthday' => Student::toDateTime($request->birthday),
            'phone' => $request -> phone,
            'email' => $request -> email,
            'nickname' => $request -> nickname,
            'hobbies' => $request -> hobbies,
            'country' => $request -> country,
            'class_id' => $request -> class_id
        ));
        
        $person->save();

        Session::flash('success', "Data was successfully saved.");

        return redirect()->route('personal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Student::findOrFail($id);

        return view('personal.edit')-> withPerson($person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Student::findOrFail($id);

        $classes = mClass::pluck("class_name", "id");
        $classes->prepend('-- Chọn lớp --', '');
        return view('personal.edit', compact(['person', 'classes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentEditFormRequest $request, $id)
    {
        $person = Student::findOrFail($id);  
        $person->birthday = Student::toDateTime($request->birthday);  
        
        $person->fullname = $request->fullname;
        $person->nickname = $request->nickname;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->hobbies = $request->hobbies;
        $person->country = $request->country;
        $person->gender = $request->fgender;
        $person->class_id = $request->class_id;
        
        $person->save();
        Session::flash('success', "Data was successfully saved.");

        return redirect()->route('personal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Student::findOrFail($id);
        $person->delete();        
        return response() ->json();
    }
}

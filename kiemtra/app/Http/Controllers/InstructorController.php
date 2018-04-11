<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorCreateRequest;
use App\Http\Requests\InstructorUpdateRequest;
use App\Instructor;
use App\Subject;
use Illuminate\Http\Request;
use Session;
use Image;
use Storage;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::paginate(10);
        return view("instructor.index", compact("instructors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view("instructor.create", compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructorCreateRequest $request)
    {
        $instructor = new Instructor(array
            (
                'fullname' => $request->fullname,
                'gender' => $request->gender,
                'birthday' => Instructor::toDateTime($request->birthday),
                'phone' => $request->phone,
                'email' => $request->email,
                'nickname' => $request->nickname,
                'address' => $request->address,
            ));
            
            if($request->hasFile('image')){
                $image = $request->file('image');
                $fileName = time(). ".". $image->getClientOriginalExtension();
                $location = public_path("images/". $fileName);
                Image::make($image)->resize(200, 200)->save($location);
                $instructor->image = $fileName;
            }

        $instructor->save();
        
        $instructor->subjects()->sync($request->subjects, false);

        Session::flash('success', "Instructor was successfully created.");

        return redirect()->route('instructors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instructor = Instructor::findOrFail($id);
        $subjects = Instructor::findOrFail($id)->subjects();
        return view('instructor.details', compact(['instructor','subjects']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);

        $subjectsTemp = Subject::all();
        $subjects = array();
        foreach ($subjectsTemp as $subject) {
            $subjects[$subject->id] = $subject->title;
        }

        return view('instructor.edit', compact(['instructor', 'subjects']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstructorUpdateRequest $request, $id)
    {
        $instructor = Instructor::findOrFail($id);

        $instructor->fullname = $request->fullname;
        $instructor->email = $request->email;
        $instructor->birthday = Instructor::toDateTime($request->birthday);
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->gender = $request->egender;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = time(). ".". $image->getClientOriginalExtension();
            $location = public_path("images/". $fileName);
            Image::make($image)->resize(200, 200)->save($location);
            $oldFileName = $instructor->image;
            $instructor->image = $fileName;
            Storage::delete($oldFileName);
        }

        $instructor->save();

        if (isset($request->subjects)) {
            $instructor->subjects()->sync($request->subjects);
        } else {
            $instructor->subjects()->sync(array());
        }

        Session::flash('success', "Instructor was successfully updated.");

        return redirect()->route('instructors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();
        Storage::delete($instructor->image);
        return response()->json();
    }
}

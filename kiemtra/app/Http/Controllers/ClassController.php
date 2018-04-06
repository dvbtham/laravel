<?php

namespace App\Http\Controllers;

use App\mClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = mClass::paginate(10);
        return view("class.index", compact("classes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
    }

    public function getStudents($classId)
    {
        $students = mClass::with('students')->find($classId)->students;
        return view('class.students', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|unique:classes|max:250',
        ]);
        $class = new mClass([
            'class_name' => $request->class_name,
        ]);

        $class->save();

        Session::flash('success', "Data was successfully saved.");

        return redirect()->route('class.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = mClass::findOrFail($id);

        return view('class.edit', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = mClass::findOrFail($id);

        return view('class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|unique:classes|max:250',
        ]);

        $class = mClass::findOrFail($id);

        $class->class_name = $request->class_name;

        $class->save();

        Session::flash('success', "Data was successfully saved.");

        return redirect()->route('class.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = mClass::findOrFail($id);
        $class->delete();
        return response()->json();
    }
}

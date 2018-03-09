<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonalFormRequest;
use App\Http\Requests\PersonalEditFormRequest;
use App\Personal;
use Session;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Personal::paginate(10);
        return view("personal.index")-> withPeople($people);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalFormRequest $request)
    {
        $person = new Personal(array
        (
            'fullname' => $request -> fullname,
            'gender' => $request -> gender,
            'birthday' => Personal::toDateTime($request->birthday),
            'phone' => $request -> phone,
            'email' => $request -> email,
            'nickname' => $request -> nickname,
            'hobbies' => $request -> hobbies,
            'country' => $request -> country
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
        $person = Personal::findOrFail($id);

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
        $person = Personal::findOrFail($id);

        return view('personal.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalEditFormRequest $request, $id)
    {
        $person = Personal::findOrFail($id);  
        $person->birthday = Personal::toDateTime($request->birthday);  
        
        $person->fullname = $request->fullname;
        $person->nickname = $request->nickname;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->hobbies = $request->hobbies;
        $person->country = $request->country;
        $person->gender = $request->fgender;

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
        $person = Personal::findOrFail($id);
        $person->delete();        
        return response() ->json();
    }
}

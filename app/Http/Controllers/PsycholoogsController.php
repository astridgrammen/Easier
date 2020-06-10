<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psycholoog; // Verwezen naar het model Psycholoog.php
use App\User;

class PsycholoogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $psycholoogs = Psycholoog::all();
        //$psycholoogs = Psycholoog::with('availabilities');
        //dd($psycholoogs);  

        return view('psycholoogs.index')->with('psycholoogs', $psycholoogs);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('psycholoogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'telephone'=>'required',
            'address'=>'required',
            'zipcode'=>'required',
            'city'=>'required',
            'specialisation'=>'required',
            'description'=>'required',
        ]);

        $user_id = auth()->user()->id;   

        // Adding new psych data
        $psych = new Psycholoog;
        $psych->firstname = $request->input('firstname');
        $psych->lastname = $request->input('lastname');
        $psych->email = $request->input('email');
        $psych->telephone = $request->input('telephone');
        $psych->address = $request->input('address');
        $psych->zipcode = $request->input('zipcode');
        $psych->city = $request->input('city');
        $psych->specialisation = $request->input('specialisation');
        $psych->description = $request->input('description');
        
        $psych->user_id = $user_id;
        $psych->save();

        return redirect('/psycholoogs/'. $psych->id)->with('success', 'Profielgegevens bijgewerkt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $psycholoog = Psycholoog::find($id);
        return view('psycholoogs.show')->with('psycholoog', $psycholoog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}

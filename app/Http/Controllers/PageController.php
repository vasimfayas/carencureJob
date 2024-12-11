<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\JobCard;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobCard::all();
        return view('home', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'job_card_id'=>'required',
                'name' => 'required|string',
                'email' => 'required|string|email',
                'age' =>'required|integer',
                'phone'=>'required|string',
                'resume'=>'required|file|mimes:pdf,doc,docx'
            ]
        );

        if($request->hasfile('resume')){
            $path = $request->file('resume')->store('resumes','public');
            $validate['resume']=$path;
        }
        Applicant::create($validate);
        return back()->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

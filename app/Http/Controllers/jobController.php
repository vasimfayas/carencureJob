<?php

namespace App\Http\Controllers;

use App\Models\Jobcard;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class jobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Jobcard::all();


        return view('job/addJob', compact('jobs'));
    }

    public function viewPdf($id)
    {
        $applicant = Applicant::findOrFail($id);
        $fileUrl = asset('storage/' . $applicant->resume); // Assuming the resume is stored in the public disk

        return redirect("https://docs.google.com/gview?url=$fileUrl&embedded=true");
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
        $validate = $request->validate([
            'logo' => 'required',
            'job_title' => 'required',
            'location' => 'required',
            'posted_date' => 'required|date',
            'last_date_to_apply' => 'required|date',
            'whatsapp_no' => 'required',
            'email_of_host' => 'required',
            'job_features' => 'required',
            'other_requirements' => 'required',
        ]);
        $path = $request->file('logo')->store('logos', 'public');
        $validate['logo'] = $path;


        $job = JobCard::create($validate);
        if (!empty($request->emails_to_receive_applications)) {
            foreach ($request->emails_to_receive_applications as $email) {
                $job->emails()->create(['email' => $email]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Job added successfully!');
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
        $job = Jobcard::findOrFail($id);

        return view('job/editJob', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate as an image
            'job_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'last_date_to_apply' => 'required|date|after_or_equal:posted_date',
            'whatsapp_no' => 'required|string|max:15',
            'email_of_host' => 'required|email',
            'job_features' => 'nullable|string',
            'other_requirements' => 'nullable|string',
        ]);

        // Find the job by its ID
        $job = JobCard::findOrFail($id);

        // Handle the logo update
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($job->logo && Storage::exists('public/' . $job->logo)) {
                Storage::delete('public/' . $job->logo);
            }
            // Store the new logo
            $path = $request->file('logo')->store('logos', 'public');
            $validate['logo'] = $path;
        } else {
            unset($validate['logo']); // Don't overwrite the logo if a new one isn't uploaded
        }


        // Handle the deletion of existing emails
        if ($request->filled('existing_email_ids')) {
            // Get the remaining IDs of emails to keep
            $remainingIds = array_filter($request->existing_email_ids); // Filter out blank (deleted) IDs
            // Delete emails not in the remaining list
            $job->emails()->whereNotIn('id', $remainingIds)->delete();
        } else {
            // If no existing IDs are provided, delete all emails
            $job->emails()->delete();
        }
        // Handle adding new emails to receive applications
        if (!empty($request->emails_to_receive_applications)) {
            foreach ($request->emails_to_receive_applications as $email) {
                // Only add new email if it doesn't already exist
                if (!$job->emails()->where('email', $email)->exists()) {
                    $job->emails()->create(['email' => $email]);
                }
            }
        }

        // Update the job record
        $job->update($validate);



        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Job updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Jobcard::findOrFail($id);
        $job->delete();
        return redirect()->route('dashboard')->with('success', 'Jobcard deleted successfully');
    }
}

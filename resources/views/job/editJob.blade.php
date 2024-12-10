@extends('layouts.master')

@section('title','Jobs')

@section('content')
<div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column ">
  <div class="card card-plain">
    <div class="card-header">
      <h4 class="font-weight-bolder">Edit job details :</h4>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

    </div>
    <div class="card-body">
    <form role="form" method="POST" action="{{ route('Job.update',$job->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <!-- Add LOGO -->
        <p class="mb-0">Add Logo</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label" for="logo"></label>
            <input type="file" class="form-control" id="logo" name="logo">
           
        </div>
        @if($job->logo)
        <div class="mb-3">
            <label>Current Logo</label>
            <img src="{{asset('storage/'.$job->logo)}}" alt="Logo" class="img-fluid" style="max-height: 100px;">
        </div>
        @endif


        <!-- Job title -->
        <p class="mb-0">Job title</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="text" class="form-control" name="job_title" value="{{ old('Job_title',$job->job_title) }}">
        </div>

        <!-- Location -->
        <p class="mb-0">Location</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="text" class="form-control" name="location" value="{{ old('location',$job->location) }}">
        </div>

        <!-- Posted date -->
        <p class="mb-0">Posted date</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="date" class="form-control" name="posted_date" value="{{ old('posted_date',$job->posted_date) }}">
        </div>

        <!-- Last date to apply -->
        <p class="mb-0">Last date to apply</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="date" class="form-control" name="last_date_to_apply" value="{{ old('last_date_to_apply',$job->last_date_to_apply) }}">
        </div>

        <!-- Whatsapp No -->
        <p class="mb-0">Whatsapp No</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="text" class="form-control" name="whatsapp_no" value="{{ old('whatsapp_no',$job->whatsapp_no) }}">
        </div>

        <!-- Email of the host -->

        <p class="mb-0">Email of the host</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="text" class="form-control" name="email_of_host" value="{{ old('email_of_host',$job->email_of_host) }}">
        </div>

        <!-- Job features -->
        <p class="mb-0">Job features</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label" ></label>
            <textarea class="form-control"  name="job_features" rows="4">{{ old('job_features',$job->job_features) }}</textarea>
        </div>

        <!-- Other requirements -->
        <p class="mb-0">Other requirements</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <textarea class="form-control" id="requirements" name="other_requirements" rows="4">{{ old('other_requirements',$job->other_requirements) }}</textarea>
        </div>

        <div id="email-input-container">
    @if(isset($job))
        @foreach($job->emails as $email)
            <div class="email-input-wrapper">
                <input type="email" class="form-control email-input" 
                       placeholder="Enter email" 
                       name="emails_to_receive_applications[]" 
                       value="{{ $email->email }}">
               
               <!-- Hidden input to track the email ID -->
            <input type="hidden" name="existing_email_ids[]" value="{{ $email->id }}" class="email-id">
             <button type="button" class="btn btn-danger btn-sm delete-email mt-2">Delete</button>
            </div>
        @endforeach
    @endif
</div>

        <!-- Emails to receive applications -->
        <label class="form-label">Emails to receive applications</label>
        <div class="input-group input-group-outline mb-3">
            <div id="email-input-container">
                <div class="email-input-wrapper">
                    <input type="email" class="form-control email-input" placeholder="Enter email" name="emails_to_receive_applications[]" value="{{ old('emails_to_receive_applications.0') }}">
                    <button type="button" class="btn btn-danger btn-sm delete-email mt-2">Delete</button>
                </div>
            </div>
        </div>

        <!-- Add another email button -->
        <button type="button" class="btn btn-link" id="add-email">Add another email</button>

        <!-- Submit button -->
        <div class="text-center">
            <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Post Job</button>
        </div>
    </form>
</div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('add-email').addEventListener('click', function() {
    // Create a new email input wrapper
    const newEmailWrapper = document.createElement('div');
    newEmailWrapper.classList.add('email-input-wrapper');

    // Create the new email input field
    const newEmailInput = document.createElement('input');
    newEmailInput.type = 'email';
    newEmailInput.classList.add('form-control', 'email-input');
    newEmailInput.placeholder = 'Enter email';
    newEmailInput.name = 'emails_to_receive_applications[]'; // Array syntax for multiple email inputs

    // Create the delete button
    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-email', 'mt-2');
    deleteButton.textContent = 'Delete';

    // Append the new email input and delete button to the wrapper
    newEmailWrapper.appendChild(newEmailInput);
    newEmailWrapper.appendChild(deleteButton);

    // Append the new wrapper to the email input container
    document.getElementById('email-input-container').appendChild(newEmailWrapper);

    // Add event listener for the delete button
    deleteButton.addEventListener('click', function() {
      newEmailWrapper.remove(); // Remove the email input field and button wrapper
    });
  });
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-email').forEach(function (deleteButton) {
        deleteButton.addEventListener('click', function () {
            const emailWrapper = this.closest('.email-input-wrapper');
            const hiddenEmailInput = emailWrapper.querySelector('.email-id');
            if (hiddenEmailInput) {
                // Mark this email for deletion by removing its value
                hiddenEmailInput.value = '';
            }
            emailWrapper.style.display = 'none'; // Hide the email input wrapper
        });
    });
});
</script>
@endpush
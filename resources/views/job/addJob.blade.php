@extends('layouts.master')

@section('title','Jobs')

@section('content')
<div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column ">
  <div class="card card-plain">
    <div class="card-header">
      <h4 class="font-weight-bolder">Add job details :</h4>
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
    <form role="form" method="POST" action="{{ route('Job.store') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Add LOGO -->
        <p class="mb-0">Add Logo</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label" for="logo"></label>
            <input type="file" class="form-control" id="logo" name="logo">
        </div>

        <!-- Job title -->
        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Job title</label>
            <input type="text" class="form-control" name="job_title" value="{{ old('job_title') }}">
        </div>

        <!-- Location -->
        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="{{ old('location') }}">
        </div>

        <!-- Posted date -->
        <p class="mb-0">Posted date</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="date" class="form-control" name="posted_date" value="{{ old('posted_date') }}">
        </div>

        <!-- Last date to apply -->
        <p class="mb-0">Last date to apply</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="date" class="form-control" name="last_date_to_apply" value="{{ old('last_date_to_apply') }}">
        </div>

        <!-- Whatsapp No -->
        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Whatsapp No</label>
            <input type="text" class="form-control" name="whatsapp_no" value="{{ old('whatsapp_no') }}">
        </div>

        <!-- Email of the host -->
        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Email of the host</label>
            <input type="text" class="form-control" name="email_of_host" value="{{ old('email_of_host') }}">
        </div>

        <!-- Job features -->
        <p class="mb-0">Job features</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label" ></label>
            <textarea class="form-control"  name="job_features" rows="4">{{ old('job_features') }}</textarea>
        </div>

        <!-- Other requirements -->
        <p class="mb-0">Other requirements</p>
        <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <textarea class="form-control" id="requirements" name="other_requirements" rows="4">{{ old('requirements') }}</textarea>
        </div>

        <!-- Emails to receive applications -->
        <label class="form-label">Emails to receive applications</label>
        <div id="email-input-container">
    @if(old('emails_to_receive_applications') || isset($jobCard))
        @foreach(old('emails_to_receive_applications', $jobCard->emails_to_receive_applications ?? []) as $index => $email)
            <div class="email-input-wrapper">
                <input type="email" class="form-control email-input" 
                       placeholder="Enter email" 
                       name="emails_to_receive_applications[]" 
                       value="{{ $email }}">
                <button type="button" class="btn btn-danger btn-sm delete-email mt-2">Delete</button>
            </div>
        @endforeach
    @else
        <div class="email-input-wrapper ">
            <input type="email" class="form-control email-input" 
                   placeholder="Enter email" 
                   name="emails_to_receive_applications[]">
            <button type="button" class="btn btn-danger btn-sm delete-email mt-2 mx-3">Delete</button>
        </div>
    @endif
</div>

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
    newEmailInput.name = 'emails[]'; // Array syntax for multiple email inputs

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
</script>
@endpush
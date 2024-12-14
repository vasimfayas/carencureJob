@extends('layouts.master')

@section('title','All Jobs')

@section('content')

<body>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Jobs</h6>
                    </div>
<a href="{{route('addjob')}}" class="btn btn-success mt-3">Add new job</a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Posted Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('storage/' . $job->logo) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="logo">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $job->job_title }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $job->email_of_host }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $job->posted_date->format('d/m/Y') }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $job->last_date_to_apply->format('d/m/Y') }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $job->location }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal-{{ $job->id }}">
                                            Apply Now
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="applyModal-{{ $job->id }}" tabindex="-1" aria-labelledby="applyModalLabel-{{ $job->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="applyModalLabel-{{ $job->id }}">Apply for {{ $job->job_title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('home.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="job_card_id" value="{{ $job->id }}">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="applicantName" class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" id="applicantName" name="name" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="applicantEmail" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="applicantEmail" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="applicantPhone" class="form-label">Phone number</label>
                                                            <input type="text" class="form-control" id="applicantPone" name="phone" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="dob" class="form-label">Date of birth</label>
                                                            <input type="date" class="form-control" id="dob" name="dob" required>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="gender">Gender</label>
                                                            <select class="form-control" name="gender" id="gender" required>
                                                                <option value="" disabled selected>Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Other">Other</option>
                                                            </select>


                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="nationality" class="form-label">Nationality</label>
                                                            <input type="text" class="form-control" id="nationality" name="nationality" required>
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="col-md-9 mb-3">
                                                            <label for="resume" class="form-label">Upload Resume</label>
                                                            <input type="file" class="form-control" id="resume" name="resume" required>
                                                        </div>


                                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No jobs available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
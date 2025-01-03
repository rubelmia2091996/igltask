@extends('master')

@section('main')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
            </span> Candidate Details
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <!-- Candidate Info -->
                    <h4>Candidate Information</h4>
                    <table class="table table-bordered mb-4">
                        <tr>
                            <th>Name</th>
                            <td>{{ $candidate->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $candidate->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $candidate->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Experience Year</th>
                            <td>{{ $candidate->experience_year }}</td>
                        </tr>
                    </table>

                    <!-- Company Experience -->
                    <h4>Company Experience</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidate->company_experience as $index => $position)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $position }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

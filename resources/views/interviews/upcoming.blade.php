@extends('master')

@section('main')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Upcoming Interviews</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Scheduled Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $candidate->name }}</td>
                                <td>{{ $candidate->email }}</td>
                                <td>{{ $candidate->phone_number }}</td>
                                <td>{{ $candidate->interview_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('interviews.downloadPhoneNumbers') }}" class="btn btn-primary">Download Phone Numbers</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

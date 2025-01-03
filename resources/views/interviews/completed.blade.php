@extends('master')

@section('main')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Completed Interviews</h3>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $candidate->name }}</td>
                                <td>{{ $candidate->email }}</td>
                                <td>{{ $candidate->phone_number }}</td>
                                <td>
                                    <form action="{{ route('candidates.updateStatus', ['id' => $candidate->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="hired" {{ $candidate->status == 'hired' ? 'selected' : '' }}>Hired</option>
                                            <option value="passed" {{ $candidate->status == 'passed' ? 'selected' : '' }}>Passed</option>
                                            <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </td>
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

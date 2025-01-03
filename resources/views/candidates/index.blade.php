@extends('master')
@section('main')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Candidate List <span><a href="{{ url('/candidate/hired') }}">Hired List</a></span> <a
                href="{{ url('/candidate/rejected') }}">Rejected List</a></span>
        </h3>
        <a href="{{ route('candidates.create') }}">Create New Candidate</a>
    </div>
    <div class="row">
        <form action="{{ route('import.candidate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">File:</label>
                <input type="file" name="file" id="file" class="form-control" accept=".csv,.xlsx"  required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
        <table border="1">
            <tr>
                <th>Sl. No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Experience Year</th>
                <th>Actions</th>
            </tr>
            @foreach($candidates as $key=>$candidate)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $candidate->name }}</td>
                <td>{{ $candidate->email }}</td>
                <td>{{ $candidate->phone_number }}</td>
                <td>{{ $candidate->experience_year }}</td>
                <td>
                    <a href="{{ route('candidates.show', $candidate) }}">View</a>
                    <a href="{{ route('candidates.edit', $candidate) }}">Edit</a>
                    <form action="{{ route('candidates.destroy', $candidate) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
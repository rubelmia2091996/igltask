@extends('master')
@section('main')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
            </span> Schedule
        </h3>
    </div>
    <div class="row">
        <form action="{{ route('candidates.scheduleInterviews') }}" method="POST">
            @csrf
            @foreach($candidates as $candidate)
                <div>
                    <input type="checkbox" name="candidates[]" value="{{ $candidate->id }}">
                    {{ $candidate->name }}
                </div>
            @endforeach
            <button type="submit">Schedule Interviews</button>
        </form>
        
    </div>
</div>
@endsection

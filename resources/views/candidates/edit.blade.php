@extends('master')

@section('main')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
            </span> Edit Candidate
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $candidate->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $candidate->email) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $candidate->phone_number) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="experience_year">Experience Year:</label>
                            <input type="text" class="form-control" id="experience_year" name="experience_year" value="{{ old('experience_year', $candidate->experience_year) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="company_experience">Company Experience:</label>
                            <div id="companyExperienceContainer">
                                @php
                                $count = 0;
                                @endphp
                                @foreach($candidate->company_experience as $index => $experience)
                                    
                                    <div class="company-experience-row mb-2">
                                        <div class="d-flex justify-content-between">
                                            <input type="text" class="form-control me-2" name="company_experience[{{ $count }}][company_name]" placeholder="Company Name" value="{{ old('company_experience.' . $count . '.company_name', $index) }}" required>
                                            <input type="text" class="form-control me-2" name="company_experience[{{ $count }}][position]" placeholder="Position" value="{{ old('company_experience.' . $count . '.position', $experience) }}" required>
                                            <button type="button" class="btn btn-danger remove-row">-</button>
                                        </div>
                                    </div>
                                @php
                                    $count++;
                                @endphp
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success" id="addCompanyExperienceRow">+</button>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let experienceIndex = {{ count($candidate->company_experience) }};
    
    // Add new company experience row
    document.getElementById('addCompanyExperienceRow').addEventListener('click', function() {
        const container = document.getElementById('companyExperienceContainer');
        const newRow = document.createElement('div');
        newRow.classList.add('company-experience-row', 'mb-2');
        newRow.innerHTML = `
            <div class="d-flex justify-content-between">
                <input type="text" class="form-control me-2" name="company_experience[${experienceIndex}][company_name]" placeholder="Company Name" required>
                <input type="text" class="form-control me-2" name="company_experience[${experienceIndex}][position]" placeholder="Position" required>
                <button type="button" class="btn btn-danger remove-row">-</button>
            </div>
        `;
        container.appendChild(newRow);
        experienceIndex++;
    });

    // Remove company experience row
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('.company-experience-row').remove();
        }
    });
</script>

@endsection

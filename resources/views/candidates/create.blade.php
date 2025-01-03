@extends('master')
@section('main')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
            </span> Create Candidate
        </h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('candidates.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter candidate's name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter candidate's email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter candidate's phone number" required>
                        </div>

                        <div class="mb-3">
                            <label for="experience_year" class="form-label">Experience Year:</label>
                            <input type="text" name="experience_year" id="experience_year" class="form-control" placeholder="Enter total years of experience" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Experience:</label>
                            <div id="company-experience-container">
                                <div class="row g-3 mb-2 company-experience-row">
                                    <div class="col-md-5">
                                        <input type="text" name="company_experience[0][company_name]" class="form-control" placeholder="Company Name" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="company_experience[0][position]" class="form-control" placeholder="Position" required>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button type="button" class="btn btn-success add-row">
                                            <i class="mdi mdi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let experienceIndex = 1;

    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('company-experience-container');

        // Add a new row
        container.addEventListener('click', function (e) {
            if (e.target.closest('.add-row')) {
                e.preventDefault();

                const newRow = document.createElement('div');
                newRow.classList.add('row', 'g-3', 'mb-2', 'company-experience-row');
                newRow.innerHTML = `
                    <div class="col-md-5">
                        <input type="text" name="company_experience[${experienceIndex}][company_name]" class="form-control" placeholder="Company Name" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="company_experience[${experienceIndex}][position]" class="form-control" placeholder="Position" required>
                    </div>
                    <div class="col-md-2 text-center">
                        <button type="button" class="btn btn-danger remove-row">
                            <i class="mdi mdi-minus"></i>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
                experienceIndex++;
            }
        });

        // Remove a row
        container.addEventListener('click', function (e) {
            if (e.target.closest('.remove-row')) {
                e.preventDefault();
                const row = e.target.closest('.company-experience-row');
                if (row) {
                    row.remove();
                }
            }
        });
    });
</script>

@endsection

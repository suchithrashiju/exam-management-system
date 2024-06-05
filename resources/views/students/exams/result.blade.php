@extends('layouts.student-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center mb-0">Assessment Result</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">{{ $exam->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><strong>Time Taken:</strong> {{ $userExam->exam_duration }}</p>
                                        <p class="card-text"><strong>Status:</strong>
                                            <span
                                                class="badge badge-{{ $userExam->status == 'pass' ? 'success' : 'danger' }}">
                                                {{ strtoupper($userExam->status) }}
                                            </span>
                                        </p>
                                        <p class="card-text"><strong>Marks:</strong>
                                            {{ $userExam->score }}/{{ $exam->total_mark }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

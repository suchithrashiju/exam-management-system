@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="text-right">
            <a href="{{ route('exams.completedExams') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">Exam Summary</h2>
                <div class="card">
                    <div class="card-header">
                        <h4> Result</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Exam Name:{{ $userExam->exam->name }} </p>
                        <p class="card-text">Start Time: {{ formatDateTime($userExam->start_time) }} </p>
                        <p class="card-text">End Time: {{ formatDateTime($userExam->end_time) }} </p>
                        <p class="card-text">Time Taken: {{ $userExam->exam_duration }} minutes</p>
                        <p class="card-text">Status: <span
                                class="badge badge-{{ $userExam->status == 'pass' ? 'success' : 'danger' }}">
                                {{ strtoupper($userExam->status) }}
                            </span></p>
                        <p class="card-text">Marks: {{ $userExam->score }}/{{ $userExam->exam->total_mark }}</p>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h4> Exam Detail</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Exam Duration: {{ $exam->duration }} minutes</p>
                        <p class="card-text">Total Mark: {{ $exam->total_marks }}</p>
                        <p class="card-text">Pass Mark: {{ $exam->pass_mark }}</p>
                        <p class="card-text">No of Questions: {{ $exam->questions->count('id') }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Student Details</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Name: {{ $userExam->user->name }} </p>
                        <p class="card-text">Email: {{ $userExam->user->email }} </p>
                        <p class="card-text">Mobile: {{ $userExam->user->mobile }}</p>
                        <p class="card-text">Address: {{ $userExam->user->address }}</p>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="text-right">
            <a href="{{ route('exams.completedExams') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">Student View</h2>
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Name: {{ $user->name }} </p>
                        <p class="card-text">Email: {{ $user->email }} </p>
                        <p class="card-text">Mobile: {{ $user->mobile }}</p>
                        <p class="card-text">Address: {{ $user->address }}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Exam History</h4>
                    </div>
                    <div class="card-body">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Exam Title</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Total mark</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userExams as $user_exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user_exam->exam->name }}</td>
                                        <td>{{ $user_exam->exam_duration }}</td>
                                        <td> <span
                                                class="badge badge-{{ $user_exam->status == 'pass' ? 'success' : 'danger' }}">
                                                {{ strtoupper($user_exam->status) }}
                                            </span>

                                        </td>
                                        <td>{{ $user_exam->score }}</td>
                                        <td>
                                            <a href="{{ route('exams.showResult', ['exam' => $user_exam->exam_id, 'student' => $user_exam->user_id]) }}"
                                                class="btn btn-primary">Exam Summary</a>

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

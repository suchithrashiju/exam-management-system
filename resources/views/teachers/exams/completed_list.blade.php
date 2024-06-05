@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Exam History</h1>
        <br>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Student Name</th>
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
                        <td>{{ $user_exam->user->name }}</td>
                        <td>{{ $user_exam->exam->name }}</td>
                        <td>{{ $user_exam->exam_duration }}</td>
                        <td> <span class="badge badge-{{ $user_exam->status == 'pass' ? 'success' : 'danger' }}">
                                {{ strtoupper($user_exam->status) }}
                            </span>

                        </td>
                        <td>{{ $user_exam->score }}</td>
                        <td>
                            <a href="{{ route('exams.showResult', ['exam' => $user_exam->exam_id, 'student' => $user_exam->user_id]) }}"
                                class="btn btn-primary">Result</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.student-dashboard')

@section('content')
    <div class="container">
        <h1>Online Assessments</h1>
        <br>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Exam Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Total mark</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $exam->name }}</td>
                        <td>{{ $exam->description }}</td>
                        <td>{{ $exam->duration }} minutes</td>
                        <td>{{ $exam->total_mark }}</td>
                        <td>
                            @php
                                $applied = checkAttendExam($exam->id);
                            @endphp
                            @if ($applied)
                                <a href="{{ route('student.viewExamResult', $exam->id) }}" class="btn btn-primary">Assessment
                                    Result</a>
                            @else
                                <a href="{{ route('student.attendExam', $exam->id) }}" class="btn btn-warning">Take
                                    Assessment</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

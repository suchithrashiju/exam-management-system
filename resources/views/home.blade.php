@extends('layouts.home_layout')
@section('content')
    <div class="col-md-12">
        <div class="row">
            <h1 class="text-center">Welcome to the Exam Management System</h1>
            <p>The Exam Management System (EMS) is a transformative educational tool that streamlines the assessment
                process. It provides a robust platform for educators to create, manage, and deliver exams with ease,
                while offering students the flexibility to take tests securely from any location. The EMS automates
                the tedious tasks of exam scheduling, question paper generation, and result processing, thereby
                enhancing the efficiency of educational institutions. With its comprehensive analytics, the system
                offers valuable insights into student performance, fostering an environment of continuous
                improvement and academic excellence</p>
            @auth
            @else
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch mb-4">
                            <div class="card text-center w-100">
                                <div class="card-header">
                                    <h4>Student Portal</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-5">
                                        <img src="{{ asset('assets/student-ui/images/avatar/1.png') }}" alt="Student Avatar"
                                            class="rounded-circle" width="100">
                                    </div>
                                    <a href="{{ route('student.login') }}" class="btn btn-primary">Login</a>
                                    <p class="card-text mt-2">Don't have an account? <a
                                            href="{{ route('student.register') }}">Create
                                            one</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex  mb-4">
                            <div class="card text-center w-100">
                                <div class="card-header">
                                    <h4>Teacher Portal</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-5">
                                        <img src="{{ asset('assets/student-ui/images/avatar/2.png') }}" alt="Student Avatar"
                                            class="rounded-circle" width="100">
                                    </div>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @if ($exams->isEmpty())
                            <div class="alert alert-info" role="alert">
                                Currently, there are no available online assessments.
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header">
                                    <h4>Online Assessments</h4>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <div class="accordion">
                                            @foreach ($exams as $exam)
                                                <div class="accordion-item">
                                                    <div class="accordion-header">
                                                        <h5 class="accordion-title">{{ $loop->iteration }}.
                                                            {{ $exam->name }}</h5>
                                                    </div>
                                                    <div class="accordion-content">
                                                        <p>{{ $exam->description }}</p>
                                                        <p>Duration: {{ $exam->duration }} minutes</p>
                                                        <p>Total mark: {{ $exam->total_mark }}</p>
                                                        <div>
                                                            @auth
                                                                @if (auth()->user()->role == 'student')
                                                                    @php
                                                                        $applied = checkAttendExam($exam->id);
                                                                    @endphp
                                                                    @if ($applied)
                                                                        <a href="{{ route('student.viewExamResult', $exam->id) }}"
                                                                            class="btn btn-primary">Assessment Result</a>
                                                                    @else
                                                                        <a href="{{ route('student.attendExam', $exam->id) }}"
                                                                            class="btn btn-warning">Take Assessment</a>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                <a href="{{ route('student.register') }}"
                                                                    class="btn btn-primary">Register for Assessment</a>

                                                                <a href="{{ route('student.login') }}"
                                                                    class="btn btn-secondary">Login for Assessment</a>
                                                            @endauth

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const accordionItems = document.querySelectorAll(".accordion-item");

            accordionItems.forEach(item => {
                const header = item.querySelector(".accordion-header");

                header.addEventListener("click", function() {
                    item.classList.toggle("active");
                });
            });
        });
    </script>

@endsection

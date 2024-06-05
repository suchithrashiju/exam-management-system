@extends('layouts.student-dashboard')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ $exam->name }}</h1>
        <div class="text-center">
            <p>All questions are mandatory.</p>
            <div>
                <button class="btn btn-primary" onclick="startTimer()" id="btnStart">Start Exam</button>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <p>Total number of questions: {{ $exam->questions->count('id') }}</p>
                        <p>Each question carries 1 mark</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>Time allotted: {{ $exam->duration }} minutes</p>
                        <p id="timer">Timer: <span id="timer_style"><label id="minutes">00</label>:<label
                                    id="seconds">00</label></span></p>

                    </div>
                </div>
            </div>
        </div>

        <hr>

        <form id="online-exam-form" method="POST" action="{{ route('student.submitExam', $exam->id) }}">
            @csrf
            <input type="hidden" name="exam_id" value="{{ $exam->id }}" readonly>
            <input id="start_time" type="hidden" name="start_time" value="">
            <input id="end_time" type="hidden" name="end_time" value="">

            <div class="question-container">
                <div class="row">
                    @foreach ($exam->questions as $index => $question)
                        <div class="col-md-12">
                            <p>{{ $index + 1 }}.<span class="ml-1">{{ $question->question_text }}</span>
                            </p>
                            <input id="question_id{{ $index }}" type="hidden" name="question_id[]"
                                value="{{ $question->id }}" readonly>
                            <input id="question{{ $index }}" type="hidden" name="question[]"
                                value="{{ $question->question_text }}" readonly>
                            <input id="choices{{ $index }}" type="hidden" name="choices[]"
                                value="{{ $question->choice1 . '|' . $question->choice2 . '|' . $question->choice3 . '|' . $question->choice4 }}"
                                readonly>
                            <div class="col-md-12 ">
                                <label class="d-flex"><input type="radio" name="answers[{{ $index }}]"
                                        value="choice1">
                                    <span class="ml-2"> A) {{ $question->choice1 }}</span></label>
                                <label class="d-flex"><input type="radio" name="answers[{{ $index }}]"
                                        value="choice2">
                                    <span class="ml-2"> B) {{ $question->choice2 }}</span></label>
                                <label class="d-flex"><input type="radio" name="answers[{{ $index }}]"
                                        value="choice3">
                                    <span class="ml-2">C) {{ $question->choice3 }}</span></label>
                                <label class="d-flex"><input type="radio" name="answers[{{ $index }}]"
                                        value="choice4">
                                    <span class="ml-2">D) {{ $question->choice4 }}</span></label>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-3" id="submit-btn-sec">
                <button type="submit" class="btn btn-primary d-none" id="btnTestSubmit">Submit</button>
            </div>
        </form>

    </div>
    <script>
        function startTimer() {
            var examDuration = {{ $exam->duration * 60 * 1000 }};
            var startTime = Date.now();
            var endTime = startTime + examDuration;
            var examForm = document.getElementById('online-exam-form');
            document.getElementById('start_time').value = new Date().toISOString();
            $('#btnStart').hide();
            $('#btnTestSubmit').removeClass('d-none');

            function updateTimer() {
                var now = Date.now();
                var timeLeft = endTime - now;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('timer_style').innerHTML = "Time is Up!";
                    document.getElementById('timer_style').style.color = 'red';
                    examForm.submit();
                } else {
                    var seconds = Math.floor((timeLeft / 1000) % 60);
                    var minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                    document.getElementById("seconds").textContent = pad(seconds);
                    document.getElementById("minutes").textContent = pad(minutes);
                }

                document.getElementById('end_time').value = new Date().toISOString();

            }

            function pad(number) {
                return number < 10 ? '0' + number : number;
            }

            var timerInterval = setInterval(updateTimer, 1000);
        }

        window.addEventListener('beforeunload', function(event) {
            examForm.submit();
        });

        document.getElementById('online-exam-form').addEventListener('submit', function(event) {
            var questions = document.querySelectorAll('.question-container .row .col-md-12');
            for (var i = 0; i < questions.length; i++) {
                var radios = questions[i].querySelectorAll('input[type="radio"]');
                var isChecked = false;
                for (var j = 0; j < radios.length; j++) {
                    if (radios[j].checked) {
                        isChecked = true;
                        break;
                    }
                }
                if (!isChecked) {
                    event.preventDefault();
                    alert('Please answer all questions.');
                    return false;
                }
            }
        });
    </script>
@endsection

@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Question</h1>
        <div class="text-right">
            <a href="{{ route('exams.index') }}" class="btn btn-primary mr-5">Exam List</a>
            <a href="{{ route('exams.questions.index', $exam->id) }}" class="btn btn-primary mr-5">All Questions</a>
        </div>
        <div class="error-message-sec">
            <div id="error-message" class=" text-center text-danger mt-1 mb-1"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('exams.questions.update', [$exam->id, $question->id]) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="col-md-12 ">
                        <h5>Exam Details</h5>
                        <div class="d-flex ml-3">
                            <div class="col-md-3 d-flex">
                                <label for="form_name">Name : </label>
                                <h5 class="ml-2"> {{ $exam->name }}</h5>
                            </div>
                            <div class="col-md-3  d-flex"> <label for="form_name">Duration : </label>
                                <h5 class="ml-2"> {{ $exam->duration }}</h5>
                            </div>
                            <div class="col-md-3  d-flex"> <label for="form_name">Total mark : </label>
                                <h5 class="ml-2"> {{ $exam->total_mark }}</h5>
                            </div>
                            <div class="col-md-3  d-flex"> <label for="form_name">Pass mark : </label>
                                <h5 class="ml-2"> {{ $exam->pass_mark }}</h5>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_name">Question <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="question_text" name="question_text"
                                value="{{ old('question_text', $question->question_text) }}" required>
                            @error('question_text')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="choice1">Choice 1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="choice1" name="choice1"
                                value="{{ old('choice1', $question->choice1) }}" required>
                            @error('choice1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="choice1">Choice 2 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="choice2" name="choice2"
                                value="{{ old('choice2', $question->choice2) }}" required>
                            @error('choice2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="choice1">Choice 3 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="choice3" name="choice3"
                                value="{{ old('choice3', $question->choice3) }}" required>
                            @error('choice3')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="choice1">Choice 4 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="choice4" name="choice4"
                                value="{{ old('choice4', $question->choice4) }}" required>
                            @error('choice4')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correct_choice">Correct Choice <span class="text-danger">*</span></label>
                            <select class="form-control" id="correct_choice" name="correct_choice" required>
                                <option value="">Select Correct Choice</option>
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="choice{{ $i }}"
                                        {{ old('correct_choice', $question->correct_choice) == 'choice' . $i ? 'selected' : '' }}>
                                        Choice {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('correct_choice')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $question->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 mt-5">
                        <div class="form-group">
                            <div id="hidden-form-fields"></div>
                            <button type="submit" class="btn btn-primary" id="submit-form">Save</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

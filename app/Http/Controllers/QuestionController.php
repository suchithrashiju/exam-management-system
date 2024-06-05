<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($examId)
    {
        $exam = Exam::findOrFail($examId);
        return view('teachers.questions.index', compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($examId)
    {
        $exam = Exam::findOrFail($examId);
        $totalMark = $exam->questions->sum('mark');
        if ($totalMark == $exam->total_mark) {
            return redirect()->route('exams.questions.index', $examId)->with('message', 'No more questions can be added; limit reached. To add more questions, please adjust the total mark of the exam');

        }
        return view('teachers.questions.create', compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $examId)
    {

        $validatedData = $request->validate([
            'question_text' => 'required|string|max:255',
            'choice1' => 'required|string|max:255',
            'choice2' => 'required|string|max:255',
            'choice3' => 'required|string|max:255',
            'choice4' => 'required|string|max:255',
            'correct_choice' => 'required|string|in:choice1,choice2,choice3,choice4',
            'description' => 'nullable|string',
        ]);

        $question = new Question([
            'question_text' => $validatedData['question_text'],
            'description' => $validatedData['description'],
            'choice1' => $validatedData['choice1'],
            'choice2' => $validatedData['choice2'],
            'choice3' => $validatedData['choice3'],
            'choice4' => $validatedData['choice4'],
            'correct_choice' => $validatedData['correct_choice'],
            'mark' => 1,
        ]);

        $exam = Exam::findOrFail($examId);
        $exam->questions()->save($question);

        return redirect()->route('exams.questions.index', $examId)->with('success', 'Question added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($examId, string $id)
    {
        $exam = Exam::findOrFail($examId);
        $question = Question::findOrFail($id);
        return view('teachers.questions.edit', compact('exam', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $examId, string $id)
    {
        $exam = Exam::findOrFail($examId);

        $validatedData = $request->validate([
            'question_text' => 'required|string|max:255',
            'choice1' => 'required|string|max:255',
            'choice2' => 'required|string|max:255',
            'choice3' => 'required|string|max:255',
            'choice4' => 'required|string|max:255',
            'correct_choice' => 'required|string|in:choice1,choice2,choice3,choice4',
            'description' => 'nullable|string',
        ]);
        $question = Question::findOrFail($id);
        $question->update([
            'question_text' => $validatedData['question_text'],
            'description' => $validatedData['description'],
            'choice1' => $validatedData['choice1'],
            'choice2' => $validatedData['choice2'],
            'choice3' => $validatedData['choice3'],
            'choice4' => $validatedData['choice4'],
            'correct_choice' => $validatedData['correct_choice'],
            'mark' => 1,
        ]);

        return redirect()->route('exams.questions.index', $examId)->with('success', 'Question updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($examId, string $id)
    {
        $exam = Exam::findOrFail($examId);
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('exams.questions.index', $examId)->with('success', 'Question deleted successfully.');
    }
}

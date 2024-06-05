<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher_id = auth()->id();
        $exams = Exam::where('teacher_id',$teacher_id)->get();
        return view('teachers.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:' . Exam::class,
            'description' => 'nullable|string|max:255',
            'duration' => 'required|integer',
            'total_mark' => 'required|integer',
            'pass_mark' => 'required|integer',

        ]);

        $isPublished = $request->input('is_published') === 'on';
        $isArchived = $request->input('is_archived') === 'on';
        $teacher_id = auth()->id();
        $examData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'total_mark' => $request->input('total_mark'),
            'pass_mark' => $request->input('pass_mark'),
            'teacher_id' => $teacher_id,
            'is_published' => $isPublished,
            'is_archived' => $isArchived,
        ];

        $createdExam = Exam::create($examData);

        if ($createdExam) {
            return redirect()->route('exams.index')->with('success', 'Exam detail added successfully.');

        } else {
            return redirect()->back()->with('message', 'Exam detail can not be added.');

        }

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
    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);
        return view('teachers.exams.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exam = Exam::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:exams,name,' . $id,
            'description' => 'nullable|string|max:255',
            'duration' => 'required|integer',
            'total_mark' => 'required|integer',
            'pass_mark' => 'required|integer',
        ]);

        $isPublished = $request->input('is_published') === 'on';

        $isArchived = $request->input('is_archived') === 'on';

        $exam->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'total_mark' => $request->input('total_mark'),
            'pass_mark' => $request->input('pass_mark'),
            'is_published' => $isPublished,
            'is_archived' => $isArchived,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam detail updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }

    /**
     * This PHP function updates the publish status of an exam and displays a success message.
     *
     * @param id The `id` parameter in the `updatePublishStatus` function is used to identify the
     * specific exam that needs to have its publish status updated. This function retrieves the exam
     * with the given `id`, toggles its `is_published` status, saves the changes, and then redirects
     * back to the previous
     *
     * @return a redirect back to the previous page after updating the publish status of an exam.
     */
    public function updatePublishStatus($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->is_published = !$exam->is_published;
        $exam->save();
        session()->flash('status', 'Exam status updated successfully!');
        return redirect()->back();
    }
    /**
     * The function `updateArchiveStatus` toggles the archive status of an exam and displays a success
     * message.
     *
     * @param id The `id` parameter in the `updateArchiveStatus` function is used to identify the
     * specific exam that needs to have its archive status updated. This function retrieves the exam
     * with the given `id`, toggles its `is_archived` status, saves the changes, and then redirects
     * back to the
     *
     * @return a redirect back to the previous page after updating the archive status of an exam.
     */
    public function updateArchiveStatus($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->is_archived = !$exam->is_archived;
        $exam->save();
        session()->flash('status', 'Exam archive status updated successfully!');
        return redirect()->back();
    }


    /**
     * The function `completedExams` retrieves completed exams associated with a specific teacher and
     * passes them to a view for display.
     *
     * @return A view named 'teachers.exams.completed_list' is being returned with the data from the
     * completed exams that belong to the authenticated teacher. The data includes the user exams
     * joined with the exams where the teacher_id matches the authenticated teacher's id.
     */
    public function completedExams()
    {
        $teacher_id = auth()->id();
        $userExams = UserExam::join('exams', 'user_exams.exam_id', '=', 'exams.id')
                    ->where('exams.teacher_id', $teacher_id)
                    ->get();
        return view('teachers.exams.completed_list', compact('userExams'));
    }

    /**
     * The function `showResult` retrieves exam and user exam data based on exam and user IDs and then
     * displays the result in a view.
     *
     * @param examId The `examId` parameter in the `showResult` function is used to identify the
     * specific exam for which you want to display the results. It is used to retrieve the exam details
     * from the database and to filter the user's exam results based on this exam.
     * @param userId The `` parameter in the `showResult` function represents the ID of the user
     * for whom you want to display the exam result. This parameter is used to fetch the specific
     * user's exam details from the database.
     *
     * @return A view named 'teachers.exams.view_result' is being returned with the variables  and
     *  compacted and passed to the view.
     */
    public function showResult($examId, $userId)
    {
        $exam = Exam::findOrFail($examId);
        $userExam = UserExam::where('user_id', $userId)
            ->where('exam_id', $examId)
            ->first();

        return view('teachers.exams.view_result', compact('exam', 'userExam'));
    }

}

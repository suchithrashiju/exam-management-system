<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserExam;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
     /**
     * The `studentList` function retrieves a list of users with the role 'student' and passes them to
     * the 'student_list' view for display.
     *
     * @return A view called 'student_list' is being returned with the data of all users who have the
     * role of 'student'.
     */
    public function studentList()
    {
        $users = User::where('role','student')->get();
        return view('teachers.student_list', compact('users'));
    }

    public function studentView($userId)
    {
        $user = User::findOrFail($userId);
        $userExams = UserExam::where('user_id', $userId)
            ->get();

        return view('teachers.student_view', compact('user', 'userExams'));
    }
}

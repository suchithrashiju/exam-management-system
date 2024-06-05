<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * The function `showRegisterForm` returns a view for the student registration form in PHP.
     *
     * @return A view named 'students.register' is being returned.
     */
    public function showRegisterForm()
    {
        return view('students.register');
    }
   /**
    * The loginForm function returns a view for the students' login page in PHP.
    *
    * @return A view named 'students.login' is being returned.
    */
    public function loginForm()
    {
        return view('students.login');
    }
   /**
    * This PHP function validates login credentials and redirects users based on authentication success
    * or failure.
    *
    * @param Request request The `` parameter in the `login` function is an instance of the
    * `Illuminate\Http\Request` class. It represents the HTTP request that is being made to the
    * application and contains data such as form inputs, headers, and other request information.
    *
    * @return If the authentication attempt is successful, the function will return a redirect to the
    * 'student.dashboard' route with a success message 'Signed in'. If the authentication attempt
    * fails, it will return a redirect to the 'student.login' route with a success message 'Login
    * details are not valid'.
    */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('student.dashboard')->withSuccess('Signed in');
        }

        return redirect()->route('student.login')->withSuccess('Login details are not valid');
    }

    /**
     * The function registers a new student by validating input data, creating a user record, logging
     * in the user, and redirecting to the student dashboard with a success message.
     *
     * @param Request request The `register` function in the code snippet is a method that handles the
     * registration of a new user, specifically a student. Here is an explanation of the parameters
     * used in the function:
     *
     * @return A redirect response to the 'student.dashboard' route with a success message 'Student
     * registered successfully.' is being returned after a user is successfully registered and logged
     * in.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'address' => 'nullable|string|max:500',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('student.dashboard')->with('success', 'Student registered successfully.');
    }

    /**
     * The above function logs out the user, invalidates the session, regenerates the session token,
     * and redirects to the student login route.
     *
     * @param Request request The `` parameter in the `logout` function is an instance of the
     * `Illuminate\Http\Request` class. It represents the current HTTP request and allows you to access
     * request data, headers, and other information related to the request. In this context, the
     * `` parameter is used to perform
     *
     * @return A redirect response to the 'student.login' route is being returned.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }

    /**
     * The dashboard function returns a view for the students index page in PHP.
     *
     * @return A view named 'students.index' is being returned.
     */
    public function dashboard()
    {
        return view('students.index');
    }
   /**
    * The function `applyExam` retrieves published exams with their questions and passes them to the
    * view for student exam listing.
    *
    * @return The `applyExam()` function is returning a view called 'students.exams.list' with the data
    * from the exams that are published. The data includes the id, name, duration, total_mark, and
    * description of the exams along with their associated questions.
    */
    public function applyExam()
    {
        $exams = Exam::with('questions')->where('is_published', 1)->select('id', 'name', 'duration', 'total_mark', 'description')->get();
        return view('students.exams.list', compact('exams'));
    }
   /**
    * The function `examHistory` retrieves the user's exam history and passes it to the view for
    * display.
    *
    * @return The `examHistory` function is returning a view called `exam_history` located in the
    * `students/exams` directory, and passing the `userExams` variable to the view using the `compact`
    * function.
    */
    public function examHistory()
    {
        $userExams = UserExam::where('user_id', auth()->id())->get();
        return view('students.exams.exam_history', compact('userExams'));
    }
    /**
     * The function `attendExam` checks if a user has already attended an exam and either redirects
     * them or displays the exam view.
     *
     * @param id The `attendExam` function you provided seems to be a part of a Laravel application. It
     * fetches an exam by its ID, checks if the current user has already attended the exam, and then
     * either redirects with a message or displays the exam view.
     *
     * @return If the user has already attended the exam, the function will return a redirect response
     * to the student dashboard route with a message indicating that the user has already attended the
     * exam. Otherwise, it will return a view for viewing the exam details with the exam and start time
     * data passed to the view.
     */
    public function attendExam($id)
    {
        $exam = Exam::findOrFail($id);
        $start_time = Carbon::now();
        $user_id = auth()->id();
        $userExam = UserExam::where('user_id', $user_id)
            ->where('exam_id', $exam->id)
            ->first();
        if ($userExam) {
            return redirect()->route('student.dashboard')->with('message', 'User has already attended this exam.');
        }
        return view('students.exams.view', compact('exam', 'start_time'));
    }
   /**
    * The function `viewExamResult` retrieves and displays the exam result for a specific user and
    * exam.
    *
    * @param id The `id` parameter in the `viewExamResult` function is used to identify the specific
    * exam for which the result is being viewed. It is used to fetch the exam details from the database
    * and display the result for that particular exam.
    *
    * @return The `viewExamResult` function returns a view called 'students.exams.result' with the
    * variables `` and `` passed to the view using the `compact` function.
    */
    public function viewExamResult($id)
    {
        $exam = Exam::findOrFail($id);
        $user_id = auth()->id();
        $userExam = UserExam::where('user_id', $user_id)
            ->where('exam_id', $exam->id)
            ->first();

        return view('students.exams.result', compact('exam', 'userExam'));
    }

    /**
     * The function `submitExam` processes a student's exam submission, calculates the score, and
     * stores the exam details in the database.
     *
     * @param Request request The `submitExam` function you provided is responsible for handling the
     * submission of an exam by a student. Let's break down the parameters that are being passed to
     * this function:
     *
     * @return The function `submitExam` is returning a redirect response to the route named
     * 'student.dashboard' with a success message 'Exam submitted successfully.'
     */
    public function submitExam(Request $request)
    {
        $student_id = auth()->id();
        $user = User::findOrFail($student_id);
        $exam = Exam::findOrFail($request->input('exam_id'));
        $userExam = UserExam::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->first();

        if ($userExam) {
            return redirect()->route('student.dashboard')->with('message', 'User has already attended this exam.');
        }

        $question_id_arr = $request->input('question_id');
        $choice_arr = $request->input('choices');
        $question_arr = $request->input('question');
        $answer_arr = $request->input('answers');
        $score = 0;
        $status = "fail";

        foreach ($question_arr as $index => $question) {
            $question_array[$index]['question_id'] = $question_id_arr[$index];
            $question_array[$index]['choices'] = $choice_arr[$index];
            $question_array[$index]['question'] = $question_arr[$index];
            $answer = '';
            $question = Question::find($question_id_arr[$index]);
            if ($request->input('answers')) {
                $answer = $answer_arr[$index];
                if ($question->correct_choice == $answer) {
                    $score++;
                }
            }
            $question_array[$index]['answer'] = $answer;
        }

        if ($exam->pass_mark <= $score) {
            $status = "pass";
        }

        $content = json_encode($question_array);

        $startTime = $request->input('start_time');
        $startDateTime = Carbon::parse($startTime);
        $formattedStartDate = $startDateTime->format('Y-m-d H:i:s');

        $endTime = $request->input('end_time');
        $endDateTime = Carbon::parse($endTime);
        $formattedEndDate = $endDateTime->format('Y-m-d H:i:s');

        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $formattedStartDate);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $formattedEndDate);
        $durationInSeconds = $startDateTime->diffInSeconds($endDateTime);
        $minutes = intdiv($durationInSeconds, 60);
        $seconds = $durationInSeconds % 60;
        $formattedDuration = sprintf("%d minute%s %d second%s", $minutes, $minutes == 1 ? '' : 's', $seconds, $seconds == 1 ? '' : 's');

        $userExamSubmitted = UserExam::create([
            'user_id' => $student_id,
            'exam_id' => $exam->id,
            'start_time' => $formattedStartDate,
            'end_time' => $formattedEndDate,
            'exam_duration' => $formattedDuration,
            'content' => $content,
            'score' => $score,
            'status' => $status,
        ]);

        return redirect()->route('student.applyExam')->with('success', 'Exam submitted successfully.');

    }
}

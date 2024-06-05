<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class HomeController extends Controller
{
    /**
     * The index function retrieves published exams with their associated questions and passes them to
     * the home view in a Laravel application.
     *
     * @return The `index` function is returning a view called 'home' with the data from the ``
     * variable passed to it using the `compact` function. The `` variable contains a collection
     * of exams with specific attributes selected from the database where the 'is_published' column is
     * set to 1, along with their associated questions.
     */
    public function index()
    {
        $exams = Exam::with('questions')->where('is_published', 1)->select('id', 'name', 'duration', 'total_mark', 'description')->get();
        return view('home', compact('exams'));
    }
}

<?php
/**
 * The function `checkAttendExam` checks if the authenticated user has applied for a specific exam.
 *
 * @param examId The function `checkAttendExam` takes an `` as a parameter. This function checks
 * if the currently authenticated user has applied for a specific exam identified by the ``. It
 * does this by querying the `UserExam` model to find a record where the `user_id` matches
 *
 * @return The function `checkAttendExam` is returning a boolean value indicating whether the current
 * authenticated user has applied for the exam with the given ``. If the user has applied for
 * the exam, it will return `true`, otherwise it will return `false`.
 */
function checkAttendExam($examId)
{
    $userExam = App\Models\UserExam::where('user_id', auth()->id())
        ->where('exam_id', $examId)
        ->first();
    $isApplied = false;
    if ($userExam) {
        $isApplied = true;
    }
    return $isApplied;
}

/**
 * The function `formatDateTime` in PHP uses the Carbon library to parse a date and time string and
 * format it as 'd-m-Y H:i:s'.
 *
 * @param date The `formatDateTime` function takes a date as input and uses the Carbon library to parse
 * and format it in the 'd-m-Y H:i:s' format. This format represents the day, month, year, hour,
 * minute, and second of the given date.
 *
 * @return The function `formatDateTime` takes a date as input, parses it using the Carbon library, and
 * then formats it to display the date in the format 'd-m-Y H:i:s' (day-month-year hour:minute:second).
 * The function returns the formatted date and time string.
 */
function formatDateTime($date)
{
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
}

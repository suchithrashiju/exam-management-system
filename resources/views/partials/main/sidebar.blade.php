<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{ route('dashboard') }}"><i class="icon icon-single-04"></i><span
                        class="nav-text">Dashboard</span></a>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-copy-06"></i><span class="nav-text">Exams</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('exams.index') }}">Exam List</a></li>
                    <li><a href="{{ route('exams.create') }}">Add Exam</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-copy-06"></i><span class="nav-text">Students</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('teacher.studentList') }}">Student List</a></li>
                    <li><a href="{{ route('exams.completedExams') }}">Exam Attendance Records</a></li>
                </ul>
            </li>







        </ul>
    </div>
</div>

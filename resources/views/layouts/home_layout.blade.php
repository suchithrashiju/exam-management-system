<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') {{ config('app.name') }} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="{{ asset('assets/student-ui/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/student-ui/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/student-ui/css/dev.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <style>
        body,
        html {
            height: 100%;
            ;
        }

        .home-header {
            background-color: #e9ecef;
            padding: 10px;
            text-align: center;
            font-size: 1rem;
        }

        .content {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .main {
            flex: 1;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <div class="content">
        @include('partials.home_header')


        <main class="main container mt-5">
            @yield('content')
        </main>

        @include('partials.studentui.footer')
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')

</body>

</html>

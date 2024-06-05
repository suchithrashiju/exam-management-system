@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Student List</h1>
        <div class="text-right">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }} </td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <a href="{{ route('teacher.studentView', $user->id) }}" class="btn btn-primary ml-2">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

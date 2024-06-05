@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Exams</h1>
        <div class="text-right">
            <a href="{{ route('exams.create') }}" class="btn btn-primary">Add Exam</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Total Mark</th>
                    <th>Pass Mark</th>
                    <th>Publish Status</th>
                    <th>Archived Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $exam->name }}</td>
                        <td>{{ $exam->duration }} minutes</td>
                        <td>{{ $exam->total_mark }}</td>
                        <td>{{ $exam->pass_mark }}</td>
                        <td>
                            <form action="{{ route('exams.updatePublishStatus', $exam->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    {{ $exam->is_published ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                        </td>
                        <td>

                            <form action="{{ route('exams.updateArchiveStatus', $exam->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-secondary">
                                    {{ $exam->is_archived ? 'Unarchive' : 'Archive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('exams.questions.index', $exam->id) }}"
                                    class="btn btn-primary ml-2">Questions</a>

                                <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning ml-2">Edit</a>
                                @if (!$exam->is_published && !$exam->is_archived)
                                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger ml-2"
                                            onclick="return confirm('Are you sure you want to delete this exam?')">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

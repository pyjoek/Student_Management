@extends('admin')

@section('header')
Attendance
@endsection

@section('content')
<div class="table-section">
    <form action="{{ route('attendance') }}" method="POST">
        @csrf
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <input type="text" name="attendance[{{ $index }}][name]" value="{{ $user->name }}" class="form-control form-control-sm" readonly>
                            <input type="hidden" name="student_id" value="{{ $user->id }}">
                        </td>
                        <td>
                            <select name="status" class="form-select form-select-sm" required>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                            </select>
                        </td>
                        <td>
                            <input type="date" name="date" class="form-control form-control-sm" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end mt-2">
            <button type="submit" class="btn btn-sm btn-success">Submit All Attendance</button>
        </div>
    </form>
</div>

@endsection
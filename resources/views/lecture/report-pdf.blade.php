<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background: #f2f2f2; }
        h3 { text-align: center; }
    </style>
</head>
<body>
    <h3>Student Attendance Report (Last 30 Days)</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Total Days</th>
                <th>Days Present</th>
                <th>Attendance %</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->totalDays }}</td>
                    <td>{{ $student->presentDays }}</td>
                    <td>{{ $student->percentage }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

@extends('student.app')

@section('header')
Student Dashboard
@endsection

@section('content')
<div class="container">

    {{-- Summary Cards --}}
    <div class="row mt-5">
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Days (Last 30)</h5>
                    <h4>{{ $totalDays }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Days Attended</h5>
                    <h4>{{ $attendedDays }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Days Missed</h5>
                    <h4>{{ $missedDays }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Attendance Pie Chart --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Attendance (Last 30 Days)</h5>
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('attendanceChart'), {
        type: 'pie',
        data: {
            labels: ['Attended Days', 'Missed Days'],
            datasets: [{
                label: 'Attendance (30 Days)',
                data: [{{ $attendedDays }}, {{ $missedDays }}],
                backgroundColor: ['#28a745', '#dc3545'] // green, red
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a,b)=>a+b,0);
                            const value = context.raw;
                            const percent = total ? ((value / total) * 100).toFixed(1) : 0;
                            return context.label + ': ' + value + ' ('+percent+'%)';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

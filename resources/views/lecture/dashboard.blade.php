@extends('lecture.admin')

@section('header')
Dashboard
@endsection

@section('content')
<div class="container">

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Four Summary Cards --}}
    <div class="row mt-5">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h4>{{ $totalUsers }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Lectures</h5>
                    <h4>{{ $totalLectures }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <h4>{{ $totalStudents }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Courses</h5>
                    <h4>{{ $totalCourses }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row mt-4">
        {{-- Registrations Pie --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Student Registrations (Last 30 Days)</h5>
                    <canvas id="studentsPieChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Attendance Today Pie --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Attendance Today (out of {{ $expectedStudents }} students)</h5>
                    <canvas id="attendancePieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Student Registrations Pie
    new Chart(document.getElementById('studentsPieChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Students Registered',
                data: {!! json_encode($counts) !!},
                backgroundColor: [
                    '#007bff','#28a745','#ffc107','#dc3545','#6f42c1',
                    '#20c997','#fd7e14','#6610f2','#17a2b8','#e83e8c',
                    '#adb5bd','#198754','#0dcaf0','#ff5733','#2ecc71',
                    '#f39c12','#9b59b6','#34495e','#1abc9c','#d35400',
                    '#c0392b','#7f8c8d','#8e44ad','#27ae60','#2980b9',
                    '#e67e22','#f1c40f','#95a5a6','#16a085','#2c3e50'
                ]
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a,b)=>a+b,0);
                            const value = context.raw;
                            const percent = ((value / total) * 100).toFixed(1);
                            return context.label + ': ' + value + ' ('+percent+'%)';
                        }
                    }
                }
            }
        }
    });

    // Attendance Today Pie
    new Chart(document.getElementById('attendancePieChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($attendanceLabels) !!},
            datasets: [{
                label: 'Attendance Today',
                data: {!! json_encode($attendanceCounts) !!},
                backgroundColor: ['#28a745','#dc3545'] // green = present, red = absent
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a,b)=>a+b,0);
                            const value = context.raw;
                            const percent = ((value / total) * 100).toFixed(1);
                            return context.label + ': ' + value + ' ('+percent+'%)';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

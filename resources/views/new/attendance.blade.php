@extends('admin')

@section('content')
<div class="table-section">
    <form action="{{ route('attendance')}}" method="post">
        @csrf
        <table>
            @foreach($users as $index =>  $user)
                <tr>
                    <td>{{$index+1}}</td>
                    <td><input type="text" name="name" value="{{$user->name}}" readonly></td>
                    <td>
                        <select name="status" id="">
                            <option value="absent">Absent</option>
                            <option value="present">Present</option>
                        </select>
                    </td>
                    <td><input type="date" name="date" id=""></td>
                    <td><button class="btn btn-primary">Submit</button></td>
                </tr>
            @endforeach
        </table>
    </form>
</div>
@endsection
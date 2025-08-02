@extends('admin')

@section('content')
<div class="table-section">
    <form action="" method="post">
        <table>
            @foreach($users as $index =>  $user)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->status}}</td>
                    <td>{{$user->date}}</td>
                </tr>
            @endforeach
        </table>
    </form>
</div>
@endsection
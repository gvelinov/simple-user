@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <a class="btn btn-primary float-right mb-4" href="{{ route('users.create.view') }}">Add +</a>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->employee_id }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <a href="{{ route('users.view', ['user' => $user->id]) }}">view</a>
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">edit</a>
                                        @if (Auth::user()->id !== $user->id)
                                            <a href="{{ route('users.delete', ['user' => $user->id]) }}"
                                               onclick="return confirm('Delete this user?')">delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create User</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="{{ route('users.create.post') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="inputEmail" placeholder="Email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}" placeholder="John Doe" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Address</label>
                                    <input type="text" class="form-control" name="address" id="inputAddress" value="{{ old('address') }}" placeholder="1234 Main St">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="inputPhone" value="{{ old('phone') }}" placeholder="4457897">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputBirth">Birth Date</label>
                                    <input type="date" class="form-control" name="birth_date" id="inputBirth" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputRole">Role</label>
                                    <select id="inputRole" name="role" class="form-control">
                                        <option>Choose...</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-check col-md-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="in_probation" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">In Probation</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
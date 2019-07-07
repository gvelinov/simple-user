@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Your Details</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary float-right mb-4" href="{{ route('profile.edit.post') }}">Edit Profile</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right">{{ __('Name:') }}</td>
                                <td class="font-weight-bold">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('ID:') }}</td>
                                <td class="font-weight-bold">{{ $user->employee_id }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('Email:') }}</td>
                                <td class="font-weight-bold">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('Address:') }}</td>
                                <td class="font-weight-bold">{{ $user->address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('Phone:') }}</td>
                                <td class="font-weight-bold">{{ $user->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('Birth Date:') }}</td>
                                <td class="font-weight-bold">{{ $user->birth_date ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('Role:') }}</td>
                                <td class="font-weight-bold">{{ $user->role->name}}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('In Probation:') }}</td>
                                <td class="font-weight-bold">{{ $user->in_probation ? __('Yes') : __('No') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

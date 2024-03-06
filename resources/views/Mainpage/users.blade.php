@extends('layouts.layout')

@section('title', 'Users')

@section('content')
    @push('styles')

    @endpush

    <div class="s-admin-dashboard card mb-4">
        <div class="heading d-flex justify-content-between align-content-center">
            <h1 class="whr-dashboard-heading mt-3">Users Table</h1>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary create-button-modal mt-3" data-bs-toggle="modal"
                    data-bs-target="#staticBackdropusercreate">
                Create New User
            </button>
        </div>
        <hr class="border border-dark border-3 opacity-75"/>
        <div class="card-body">

            <!-- Create Modal -->
            <div class="modal fade" id="staticBackdropusercreate" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">User Registration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('users.user-create') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Lastname" id="last_name" class="form-control"
                                           name="last_name"
                                           required autofocus>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Firstname" id="first_name" class="form-control"
                                           name="first_name" required autofocus>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Middlename" id="middle_name" class="form-control"
                                           name="middle_name" required autofocus>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email_address" class="form-control"
                                           name="email" required autofocus>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                           name="password" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Confirm Password" id="confirm-password"
                                           class="form-control" name="password_confirmation" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modals -->
            @foreach($users as $singleUser)
                <div class="modal fade" id="staticBackdropuseredit_{{ $singleUser->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $singleUser->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel_{{ $singleUser->id }}">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.edit', ['id' => $singleUser->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT') 
                                    <div class="form-group mb-3">
                                        <label for="last_name">Lastname</label>
                                        <input type="text" placeholder="Lastname" id="last_name" class="form-control"
                                               name="last_name" value="{{ $singleUser->last_name }}" required autofocus>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="first_name">Firstname</label>
                                        <input type="text" placeholder="Firstname" id="first_name" class="form-control"
                                               name="first_name" value="{{ $singleUser->first_name }}" required autofocus>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="middle_name">Middlename</label>
                                        <input type="text" placeholder="Middlename" id="middle_name" class="form-control"
                                               name="middle_name" value="{{ $singleUser->middle_name }}" required autofocus>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email_address">Email</label>
                                        <input type="text" placeholder="Email" id="email_address_users" class="form-control"
                                               name="email" value="{{ $singleUser->email }}" required autofocus>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="table-dark">
                            <th scope="col">User ID</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Middlename</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->middle_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropuseredit_{{ $user->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @elseif(count($users) < 0 || count($users) == 0)
                        <tr>
                            <td colspan="6" class="text-center">No records found.</td>
                        </tr>
                    @else
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript">

    </script>
    @endpush

@endsection
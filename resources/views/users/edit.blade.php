@extends('../layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit User</h4>
            </div>
            <form action="{{route('users.update',$user)}}" method="POST">
            <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3">
                            <label for="name" class="form-label">Name <span class="red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Enter Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 mb-3">
                            <label for="email" class="form-label">Email <span class="red">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Enter Email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3">
                            <label for="password" class="form-label">Password </label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" >
                            <small>Leave blank to keep current password</small>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 mb-3">
                            <label for="role" class="form-label">Role <span class="red">*</span></label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                                <option value="">Select Role</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" id="save" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#toptitle').text('New User');
        $('.users').css('backgroundColor','#0059b3');
    });
</script>
@endsection
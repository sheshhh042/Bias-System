@extends ('layouts.app')

@section('title','Profile Settings')

@section('content')
<div class="container">
    <h2 class="mb-4">Profile Settings</h2>
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="labels">Name</label>
                <input type="text" class="form-control" name="name" placeholder="First Name" value="{{ auth()->user()->name }}">
            </div>
            <div class="form-group col-md-6">
                <label class="labels">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ auth()->user()->email }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="labels">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone Number">
            </div>
            <div class="form-group col-md-6">
                <label class="labels">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ auth()->user()->address }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
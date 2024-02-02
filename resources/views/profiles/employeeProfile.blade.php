<x-layout>
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employee Profile</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Profile Image and Update Form -->
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <!-- Display Profile Image -->
                            <img class="profile-user-img img-fluid img-circle"
     src="{{ asset('storage/profiles/profile_' . $employee->Employee_ID . '.jpg') }}?{{ now()->timestamp }}"
     alt="User profile picture">

                        </div>
                        

                        <h3 class="profile-username text-center">{{ $employee->First_Name }} {{ $employee->Last_Name }}</h3>
                        <p class="text-muted text-center">{{ $employee->Position }}</p>
                        <!-- Update Profile Form -->
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="profile_image">Change profile image:</label>
                                <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                            </div>
                            <div class="form-group">
                                <label for="background_image">Change background image:</label>
                                <input type="file" class="form-control-file" id="background_image" name="background_image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Profile Details -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <div class="card-body">
                        <strong>Department</strong>
                        <p class="text-muted">{{ $employee->Department }}</p>
                        <hr>
                        <strong>Employee Status</strong>
                        <p class="text-muted">{{ $employee->Employee_Status }}</p>
                        <hr>
                        <!-- Add more fields as necessary -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

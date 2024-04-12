<x-layout> 

    <style> 
        .circle-img {
            width: 150px;
            height: 150px;
            overflow: hidden;
        }

        .circle-img img {
            height: 100%;
            transform: translateX(-50%);
            margin-left: 50%;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">System Users</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row"> 
            <div class="col-md-4"> 
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center"> 
                            @if ($selectedEmployee->profile_image)
                            <img class="circle-img profile-user-img img-fluid img-circle"
                                src="data:image/jpeg;base64,{{ $selectedEmployee->profile_image }}" alt="User profile picture">
                            @else
                                <!--  <img class="profile-image profile-user-img img-fluid img-circle"
                                src="{{ asset('default/path/to/default_image.jpg') }}" alt="Default profile picture"> -->
                                <div class="circle-img profile-image profile-user-img img-fluid img-circle" style="font-size: 80px;"> 
                                    <i class="fa-solid fa-user"></i>  
                                </div>
                            @endif 
                        </div>
 
                        <h3 class="profile-username text-center">{{ $selectedEmployee->First_Name }} {{ $selectedEmployee->Last_Name }}
                        </h3>
                        <p class="text-muted text-center">{{ $selectedEmployee->Position }}</p>

                        <!-- Update Profile Form -->
                        <form action="{{ route('systemusers.updateProfilePic', ['employee' => $selectedEmployee->Employee_ID]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group"> 
                                <label for="profile_image">Change profile picture</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="profile_image" name="profile_image" onchange="toggleButton()">
                                        <label class="custom-file-label" for="profile_image">Choose file</label>
                                    </div> 
                                </div> 
                            </div> 

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="uploadButton" disabled>Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right column for Profile Details -->
            <div class="col-md-8">
                <!-- Profile Details Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Information</h3>
                    </div>
                    <div class="card-body">
                        <strong>Department</strong>
                        <p class="text-muted">{{ $selectedEmployee->Department }}</p> 
                        <strong>Email</strong>
                        <p class="text-muted">{{ $selectedEmployee->Employee_Email }}</p>
                        <strong>Employee Status</strong>
                        <p class="text-muted">{{ $selectedEmployee->Employee_Status }}</p> 
                        <strong>Password Expiry Date</strong>
                        <p class="text-muted">{{ $selectedEmployee->Expiry_Date }}</p>
                        <strong>Locked Status</strong>
                        <p class="text-muted">{{ $selectedEmployee->Lock_Status }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layout>
 

<!-- bs-custom-file-input --> 
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });

    function toggleButton() {
        var fileInput = document.getElementById('profile_image');
        var uploadButton = document.getElementById('uploadButton');

        if (fileInput.files.length > 0) {
            uploadButton.disabled = false;
        } else {
            uploadButton.disabled = true;
        }
    }
</script>
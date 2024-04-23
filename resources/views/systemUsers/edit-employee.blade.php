<x-layout> 

<style>
        .ml-neg-5 {
            margin-left: -5rem;
        }

        .swal-custom-html-container ul {
            text-align: left;
            margin-left: 0;
            padding-left: 1.5em;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">System Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('systemusers') }}">System Users</a></li>
                        <li class="breadcrumb-item active">Employee Registration</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">  
            <div class="col-md-12">
                <!-- Profile Details Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-solid fa-user-pen mr-2"></i>Edit Employee</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('systemusers.updateEmployeeInfo', ['employee' => $selectedEmployee->Employee_ID]) }}" method="POST" class="p-3 rounded" id="client-form">
                            @csrf
                            <!-- <div class="form-group row ">
                                <label for="EmployeeID" class="col-sm-3 col-form-label text-right ml-neg-5">Employee ID</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Employee_ID" id="EmployeeID" placeholder="Employee ID" required>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label for="LastName" class="col-sm-3 col-form-label text-right ml-neg-5">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Last_Name" id="LastName" 
                                    value="{{ $selectedEmployee->Last_Name }}"
                                    placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="FirstName" class="col-sm-3 col-form-label text-right ml-neg-5">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="First_Name" id="FirstName"  
                                    value="{{ $selectedEmployee->First_Name }}"
                                    placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EmployeeEmail" class="col-sm-3 col-form-label text-right ml-neg-5">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="Employee_Email" id="EmployeeEmail"  
                                    value="{{ $selectedEmployee->Employee_Email }}"
                                    placeholder="Employee Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Department" class="col-sm-3 col-form-label text-right ml-neg-5">Department</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="Department" id="DepartmentSelect" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department) 
                                            <option value="{{ $department }}" {{ $selectedEmployee->Department == $department ? 'selected' : '' }}>{{ $department }}</option>

                                        @endforeach
                                        <option value="other">OTHER (SPECIFY)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="otherDepartmentInput" style="display: none;">
                                <label for="OtherDepartment" class="col-sm-3 col-form-label text-right ml-neg-5"></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="OtherDepartment" id="OtherDepartment" placeholder="Other Department">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="Position" class="col-sm-3 col-form-label text-right ml-neg-5">Position</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Position" id="Position" 
                                    value="{{ $selectedEmployee->Position }}"
                                    placeholder="Position" required>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-6">
                                    <button type="submit" id="btnSave" class="btn btn-primary btn-fixed ml-neg-5">Save</button>
                                    <a href="{{ route('systemusers') }}" class="btn btn-default btn-fixed">Cancel</a>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layout>
<script>
    // document.addEventListener('input', function(event) {
    //     if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
    //         event.target.value = event.target.value.toUpperCase();
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('employee-form');
        const submitBtn = document.getElementById('btnSave');

        // SUBMIT CONFIRMATION
        form.addEventListener('submit', function(event) {
            event.preventDefault(); 
            Swal.fire({
                title: 'CONFIRMATION MESSAGE',
                text: 'Do you want to save the changes?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) { 
                    form.submit(); 
                }
            });
        }); 

        // Check if validation errors exist and display them
        const validationErrors = @json($errors->all());
        if (validationErrors.length > 0) {
            let errorMessage = '';
            if (validationErrors.length > 1) {
                errorMessage += '<ul>';
                validationErrors.forEach(error => {
                    errorMessage += `<li>${error}</li>`;
                });
                errorMessage += '</ul>';
            } else {
                errorMessage = validationErrors[0];
            }

            Swal.fire({
                title: 'WARNING MESSAGE',
                html: errorMessage,
                icon: 'warning',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal-custom-popup',
                    htmlContainer: 'swal-custom-html-container'
                }
            });
        }

        // DISPLAY OTHER FIELD
        const departmentSelect = document.getElementById('DepartmentSelect');
        const otherDepartmentInput = document.getElementById('otherDepartmentInput');

        departmentSelect.addEventListener('change', function() {
            if (this.value === 'other') {
                otherDepartmentInput.style.display = 'flex';
            } else {
                otherDepartmentInput.style.display = 'none';
            }
        });


    });


</script>
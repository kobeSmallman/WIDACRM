<x-layout> 

<style>
    .ml-neg-5 {
        margin-left: -5rem; 
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
                    
                        <h3 class="card-title"><i class="fa-solid fa-user-plus mr-2"></i>Employee Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('save.employee') }}" method="POST" class="p-3 rounded">
                            @csrf
                            <div class="form-group row ">
                                <label for="EmployeeID" class="col-sm-3 col-form-label text-right ml-neg-5">Employee ID</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Employee_ID" id="EmployeeID" placeholder="Employee ID" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="LastName" class="col-sm-3 col-form-label text-right ml-neg-5">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Last_Name" id="LastName" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="FirstName" class="col-sm-3 col-form-label text-right ml-neg-5">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="First_Name" id="FirstName" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Department" class="col-sm-3 col-form-label text-right ml-neg-5">Department</label>
                                <div class="col-sm-6">
                                    <!-- <input type="text" class="form-control" name="Department" id="Department" placeholder="Department" required> -->
                                    <select class="form-control" name="Department" id="Department" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department }}">{{ $department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Position" class="col-sm-3 col-form-label text-right ml-neg-5">Position</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Position" id="Position" placeholder="Position" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EmployeeStatus" class="col-sm-3 col-form-label text-right ml-neg-5">Employee Status</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="Employee_Status" id="EmployeeStatus" placeholder="Employee Status">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Password" class="col-sm-3 col-form-label text-right ml-neg-5">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-fixed ml-neg-5">Save</button>
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
    document.addEventListener('input', function(event) {
        if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
            event.target.value = event.target.value.toUpperCase();
        }
    });
</script>
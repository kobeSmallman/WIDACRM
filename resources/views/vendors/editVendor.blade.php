<x-layout>
    <style>
        .card-header {
            background-color: #007bff; /* Ensure this is the only place setting the background color for card headers */
            color: #ffffff; /* White text */
        }

        .card-primary {
            border-color: #007bff; /* Consistent border color */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-default {
            background-color: #6c757d; /* Default grey */
            color: #ffffff; /* White text */
        }

        .ml-neg-5 {
            margin-left: -5rem; 
        }
    </style>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fa fa-user-edit"></i> Edit Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Vendors</a></li>
                        <li class="breadcrumb-item active">Edit Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Vendor Overview Box -->
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Vendor Overview</h3>
                    </div>
                    <div class="card-body" style="height: 300px">
                        <strong>{{ $vendor->Vendor_Name }}</strong>
                        <hr>
                        <p class="text-muted">{{ $vendor->Email }}</p>
                        <p class="text-muted">{{ $vendor->PhoneNumber }}</p>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <!-- Edit Vendor Form -->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Vendor Details</h3>
                    </div>
                    <form action="{{ route('vendors.update', $vendor->Vendor_ID) }}" method="POST" id="vendor-form">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="Vendor_Name" class="col-sm-3 col-form-label text-right">Vendor Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Vendor_Name" name="Vendor_Name" value="{{ $vendor->Vendor_Name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-3 col-form-label text-right">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="Email" name="Email" value="{{ $vendor->Email }}" required>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="PhoneNumber" class="col-sm-3 col-form-label text-right">Phone Number:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="{{ $vendor->PhoneNumber }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Active_Status" class="col-sm-3 col-form-label text-right">Active Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="Active_Status" name="Active_Status">
                                        <option value="1" {{ $vendor->Active_Status == "1" ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $vendor->Active_Status == "0" ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Remarks" class="col-sm-3 col-form-label text-right">Remarks:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="Remarks" name="Remarks">{{ $vendor->Remarks }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('vendors.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</x-layout>

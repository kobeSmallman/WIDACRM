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
                        <h3 class="card-title">Vendor Details</h3>
                    </div>
                    <form action="{{ route('vendors.update', $vendor->Vendor_ID) }}" method="POST" id="vendor-form">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="Vendor_Name" class="col-sm-3 col-form-label text-right">Vendor Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Vendor_Name" name="Vendor_Name" value="{{ $vendor->Vendor_Name }}" required disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-3 col-form-label text-right">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="Email" name="Email" value="{{ $vendor->Email }}" disabled>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="PhoneNumber" class="col-sm-3 col-form-label text-right">Phone Number:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="{{ $vendor->PhoneNumber }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Active_Status" class="col-sm-3 col-form-label text-right">Active Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="Active_Status" name="Active_Status" required disabled>
                                        <option value="1" {{ $vendor->Active_Status == "1" ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $vendor->Active_Status == "0" ? 'selected' : '' }}>Inactive</option>                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Remarks" class="col-sm-3 col-form-label text-right">Remarks:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="Remarks" name="Remarks" disabled>{{ $vendor->Remarks }}</textarea> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-auto">
                                <button type="submit" id="btnSave" class="btn btn-primary btn-fixed" style="display: none;">Save</button>
                                <button type="button" id="btnCancel" class="btn btn-default btn-fixed" style="display: none;" onclick="cancelEdit()">Cancel</button>
                                <button type="button" id="btnEdit" class="btn btn-primary btn-fixed" onclick="enableFields()">Edit</button>
                                <a href="{{ route('payment.index') }}" class="btn btn-default btn-fixed" id="btnBack">Back</a>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- For masking of phone number -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Check for the 'success' session variable and display a SweetAlert -->
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'INFORMATION MESSAGE',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <!-- Check for errors -->
        @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
            </ul>
        </div>
        @endif
    
    <script>

    $(document).ready(function() {
        // Initialize phone number mask
        $('#PhoneNumber').mask('(000) 000-0000', {placeholder: "(___) ___-____"});
        Swal.fire('Test Alert', 'This is a test to confirm SweetAlert is working.', 'success');
    });

   function enableFields() {
        document.getElementById('Vendor_Name').disabled = false;
        document.getElementById('Email').disabled = false;
        document.getElementById('PhoneNumber').disabled = false;
        document.getElementById('Active_Status').disabled = false;
        document.getElementById('Remarks').disabled = false;
        document.getElementById('btnSave').style.display = 'inline';
        document.getElementById('btnCancel').style.display = 'inline';
        document.getElementById('btnEdit').style.display = 'none';
        document.getElementById('btnBack').style.display = 'none';
    }

    function cancelEdit() {
        //Reset to original values
        document.getElementById('Vendor_Name').value = '{{ $vendor->Vendor_Name }}';
        document.getElementById('Email').value = '{{ $vendor->Email }}';
        document.getElementById('PhoneNumber').value = '{{ $vendor->PhoneNumber }}';
        document.getElementById('Remarks').value = '{{ $vendor->Remarks }}';
        document.getElementById('Active_Status').value = '{{ $vendor->Active_Status }}';

        //Disable for editing
        document.getElementById('Vendor_Name').disabled = true;
        document.getElementById('Email').disabled = true;
        document.getElementById('PhoneNumber').disabled = true;
        document.getElementById('Active_Status').disabled = true;
        document.getElementById('Remarks').disabled = true;
        document.getElementById('btnSave').style.display = 'none';
        document.getElementById('btnCancel').style.display = 'none';
        document.getElementById('btnEdit').style.display = 'inline';
        document.getElementById('btnBack').style.display = 'inline';
    }
</script>

</x-layout>

<x-layout>

<!-- Include SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- For masking of phone number -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('vendors.index')}}">Vendors</a></li>
                        <li class="breadcrumb-item active">Add Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">         
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-file-circle-plus mr-2"></i>Add New Vendor</h3>
                        </div>
                <form role="form" action="{{ route('vendors.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Vendor_Name" class="col-sm-3 col-form-label text-right ml-neg-5">Vendor Name:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" id="Vendor_Name" name="Vendor_Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Email" class="col-sm-3 col-form-label text-right ml-neg-5">Email:</label>
                            <div class="col-sm-6">
                            <input type="email" class="form-control" id="Email" name="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="PhoneNumber" class="col-sm-3 col-form-label text-right ml-neg-5">Phone Number:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Active_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Active Status:</label>
                            <div class="col-sm-6">
                            <select class="form-control" id="Active_Status" name="Active_Status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Remarks" class="col-sm-3 col-form-label text-right ml-neg-5">Remarks:</label>
                            <div class="col-sm-6">
                            <textarea class="form-control" id="Remarks" name="Remarks"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-6">
                        <button type="submit" id="btnSave" class="btn btn-primary btn-fixed ml-neg-5">Save</button> 
                        <a href="{{ route('vendors.index') }}" class="btn btn-default btn-fixed">Cancel</a>
                        </div>
                    </div>
                </form>     
            </div>
        </div>
    </section>

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
    });
    </script>

</x-layout>

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
                        <div class="form-group">
                            <label for="Vendor_Name">Vendor Name:</label>
                            <input type="text" class="form-control" id="Vendor_Name" name="Vendor_Name" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" id="Email" name="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="PhoneNumber">Phone Number:</label>
                            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required>
                        </div>
                        <div class="form-group">
                            <label for="Active_Status">Active Status:</label>
                            <select class="form-control" id="Active_Status" name="Active_Status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Remarks">Remarks:</label>
                            <textarea class="form-control" id="Remarks" name="Remarks"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="btnSave" class="btn btn-primary btn-fixed ml-neg-5">Save</button> 
                        <a href="{{ route('vendors.index') }}" class="btn btn-default">Cancel</a>
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

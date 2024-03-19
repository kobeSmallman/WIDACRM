{{-- resources/views/vendors/editVendor.blade.php --}}
<x-layout>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Vendor</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit Vendor {{ $vendor->Vendor_ID }}</h3>
                </div>
                <!-- Vendor Edit Form -->
                <form role="form" action="{{ route('vendors.update', $vendor->Vendor_ID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Vendor ID (Read-only) -->
                        <div class="form-group">
                            <label for="Vendor_ID">Vendor ID:</label>
                            <input type="text" class="form-control" id="Vendor_ID" name="Vendor_ID" value="{{ $vendor->Vendor_ID }}" readonly>
                        </div>
                        <!-- Vendor Name -->
                        <div class="form-group">
                            <label for="Vendor_Name">Vendor Name:</label>
                            <input type="text" class="form-control" id="Vendor_Name" name="Vendor_Name" value="{{ $vendor->Vendor_Name }}" required>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" id="Email" name="Email" value="{{ $vendor->Email }}" required>
                        </div>
                        <!-- Phone Number -->
                        <div class="form-group">
                            <label for="PhoneNumber">Phone Number:</label>
                            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="{{ $vendor->PhoneNumber }}" required>
                        </div>
                        <!-- Active Status -->
                        <div class="form-group">
                            <label for="Active_Status">Active Status:</label>
                            <select class="form-control" id="Active_Status" name="Active_Status">
                                <option value="1" {{ $vendor->Active_Status == "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $vendor->Active_Status == "0" ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <!-- Remarks -->
                        <div class="form-group">
                            <label for="Remarks">Remarks:</label>
                            <textarea class="form-control" id="Remarks" name="Remarks">{{ $vendor->Remarks }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Save Changes</button>
                        <a href="{{ route('vendors.index') }}" class="btn btn-default">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>

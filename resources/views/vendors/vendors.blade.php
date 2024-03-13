{{-- vendors.blade.php --}}

<x-layout>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendors</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Button to toggle the form -->
            <div class="mb-3">
                <button id="toggleVendorFormBtn" class="btn btn-primary">
                     Add New Vendor
                </button>
            </div>

            <!-- Hidden form for creating a new vendor -->
            <div id="newVendorForm" style="display: none;" class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add New Vendor</h3>
                </div>
                <form role="form" action="{{ route('vendors.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="vendorName">Vendor Name:</label>
                            <input type="text" class="form-control" id="vendorName" name="vendorName" required>
                        </div>
                        <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
                        <div class="form-group">
                            <label for="activeStatus">Active Status:</label>
                            <select class="form-control" id="activeStatus" name="activeStatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
            <!-- Bootstrap Modal for Edit Vendor -->
<div class="modal fade" id="editVendorModal" tabindex="-1" role="dialog" aria-labelledby="editVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="editVendorForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editVendorModalLabel">Edit Vendor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Dynamically filled form fields will go here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

                    <!-- Vendors Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Vendors</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="vendors-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Vendor ID</th>
                                        <th>Vendor Name</th>
                                        <th>Active Status</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $vendor)
                                        <tr>
                                            <td>{{ $vendor->Vendor_ID }}</td>
                                            <td>{{ $vendor->Vendor_Name }}</td>
                                            <td>{{ $vendor->Active_Status }}</td>
                                            <td>{{ $vendor->Email }}</td>
                                            <td>{{ $vendor->PhoneNumber }}</td>
                                            <td>{{ $vendor->Remarks }}</td>
                                            <td>
                                                <!-- Example of possible actions -->
                                                <a href="{{ route('vendors.edit', $vendor->Vendor_ID) }}" class="btn btn-info btn-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('vendors.destroy', $vendor->Vendor_ID) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                               
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-layout>

<script>
    $(function () {
        $("#vendors-table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#vendors-table_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('toggleVendorFormBtn').addEventListener('click', function() {
        var form = document.getElementById('newVendorForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
            this.textContent = 'Cancel Add New Vendor';
            this.classList.remove('btn-success');
            this.classList.add('btn-danger');
        } else {
            form.style.display = 'none';
            this.textContent = 'Add New Vendor';
            this.classList.remove('btn-danger');
            this.classList.add('btn-primary');
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        var table = $("#vendors-table").DataTable({
            ...
        });

        // Inline Editing
        $('#vendors-table').on('blur', 'td[contenteditable="true"]', function() {
            var vendorId = $(this).data('id');
            var column = $(this).data('column');
            var value = $(this).text();
        });

        // Delete vendor
        $('.delete-vendor-btn').click(function() {
            var vendorId = $(this).data('id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: '/vendors/' + vendorId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        // Reload the page or remove the row from the table
                        table.row($(this).parents('tr')).remove().draw();
                    }
                });
            }
        });
    });
</script>

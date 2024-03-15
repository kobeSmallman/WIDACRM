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
                <a href="{{ route('vendors.create') }}" class="btn btn-primary">
                     Add New Vendor
                </a>
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
                                        <th>Manage</th>
                                        <th>Vendor ID</th>
                                        <th>Vendor Name</th>
                                        <th>Active Status</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Remarks</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $vendor)
                                    <tr>
                                    <td>
                                        <a href="{{ route('vendors.edit', $vendor->Vendor_ID) }}" class="btn btn-default btn-sm" style="color: gray;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                                <form id="deleteForm{{ $vendor->VENDOR_ID }}" action="{{ route('vendors.destroy', $vendor->Vendor_ID) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default btn-sm delete-btn" data-client-id="{{ $vendor->Vendor_ID }}" onclick="return confirm('Are you sure?')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                                </form>
                                            </td>
                                            <td>  <a href="{{ route('vendors.edit', $vendor->Vendor_ID) }}">
                                            {{ $vendor->Vendor_ID }}
                                        </a></td>
                                            <td>{{ $vendor->Vendor_Name }}</td>
                                            <td>{{ $vendor->Active_Status == '1' ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $vendor->Email }}</td>
                                            <td>{{ $vendor->PhoneNumber }}</td>
                                            <td>{{ $vendor->Remarks }}</td>

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

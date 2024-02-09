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
            <div class="row">
                <div class="col-12">
                    <!-- Create New Vendor Button -->
                    <div class="mb-3">
                        <a href="{{ route('vendors.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i> Add New Vendor
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
                                        <th>Vendor ID</th>
                                        <th>Vendor Name</th>
                                        <th>Active Status</th>
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
                                <tfoot>
                                    <tr>
                                        <th>Vendor ID</th>
                                        <th>Vendor Name</th>
                                        <th>Active Status</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
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

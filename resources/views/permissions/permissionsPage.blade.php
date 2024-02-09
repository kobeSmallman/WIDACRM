<x-layout>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Permissions</h1>
        <p class="mb-4">Manage permissions for each page and view which employees have access.</p>

        <!-- Permissions Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pages and Permissions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Page ID</th>
                                <th>Page Name</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td>{{ $page->Page_ID }}</td>
                                    <td>{{ $page->Page_Name }}</td>
                                    <td>
                                        <details>
                                            <summary>View Permissions</summary>
                                            <ul>
                                                @foreach ($page->permissions as $permission)
                                                    <li>
                                                        {{ $permission->employee->First_Name }} {{ $permission->employee->Last_Name }} ({{ $permission->employee->Employee_ID }}) - Full Access: {{ $permission->Full_Control ? 'Yes' : 'No' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</x-layout>

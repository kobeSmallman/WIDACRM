<x-layout>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employee Activities</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Employee Activities</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Activity Log</h3>
                <div class="card-tools">
                    <form action="{{ route('employee-activity') }}" method="GET" class="form-inline">
                        <div class="input-group input-group-sm">
                            <input type="date" name="start_date" class="form-control" required>
                            <input type="date" name="end_date" class="form-control" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Activities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeActivities as $activity)
                            @foreach ($activity['Activities'] as $date => $types)
                                <tr>
                                    <td>{{ $activity['Employee Name'] }}</td>
                                    <td>{{ $date }}</td>
                                    <td>
                                        @foreach ($types as $type => $count)
                                            {{ $count }} {{ $type }}@if(!$loop->last), @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</x-layout>

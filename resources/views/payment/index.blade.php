<x-layout> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid"> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payment Records</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <a class="btn btn-primary mb-3 mr-3" id="show-alert">Sample Alert</a>

                <a href="{{ route('payment.create') }}" class="btn btn-primary mb-3">Add Payment</a>

                <table id="paymentRecords" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 70px !important;">Manage</th>
                            <th>Payment ID</th>
                            <th>Order ID</th>
                            <th>Payment Category</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                            <!-- Add more headers if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td> 
                                    <a href="{{ route('payment.show', $payment->PMT_ID) }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-sm">
                                    <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                                <td><a href="{{ route('payment.show', $payment->PMT_ID) }}">{{ $payment->PMT_ID }}</td>
                                <!--<td>{{ $payment->Order_ID}}</td>-->
                                <td><a href="{{ route('orders.show', $payment->Order_ID) }}">{{ $payment->Order_ID}}</td>
                                <!-- To Do: Link to Order Profile once that is already working -->
                                <td>{{ $payment->PMT_Cat}}</td>
                                <td>{{ $payment->Date}}</td>
                                <td>{{ $payment->Amount}}</td>
                                <td>{{ $payment->paymentType ? $payment->paymentType->PMT_Type_Name : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>      
</x-layout>


<script> 
   $(document).ready(function() {   
        $("#paymentRecords").DataTable({
            "aaSorting": [],
            "columnDefs": [
                { "orderable": false, "targets": [0] }
            ],
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "buttons": ["excel", "pdf", "print", "colvis"]
            
        }).buttons().container().appendTo('#paymentRecords_wrapper .col-md-6:eq(0)');

    });

    document.getElementById('show-alert').addEventListener('click', () => {
        Swal.fire({
            title: 'Hello, Laravel 10!',
            text: 'Sweetalert2 is now integrated into your Laravel 10 Vite project!',
            icon: 'success',
    });
});
</script>


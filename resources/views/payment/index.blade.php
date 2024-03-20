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
                            <th>Remarks</th>
                            <!-- Add more headers if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                            <td>
                            <a href="{{ route('payment.editPayment', $payment->PMT_ID)  }}" class="btn btn-default btn-sm" style="color: gray;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                            <form id="deleteForm{{ $payment->PMT_ID }}" action="{{ route('payment.deletePayment', $payment->PMT_ID) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-default btn-sm delete-btn" data-payment-id="{{ $payment->PMT_ID }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                    </button>
                            </form>
                            </td>
                                </td>
                                <td><a href="{{ route('payment.editPayment', $payment->PMT_ID) }}">{{ $payment->PMT_ID }}</td>
                                <td>{{ $payment->Order_ID }}</td>
                                <td>{{ $payment->PMT_Cat}}</td>
                                <td>{{ $payment->Date}}</td>
                                <td>{{ $payment->Amount}}</td>
                                <td>{{ $payment->paymentType ? $payment->paymentType->PMT_Type_Name : 'N/A' }}</td>
                                <td>{{ $payment->Remarks}}</td>
                            </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>      

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'INFORMATION MESSAGE',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif  



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

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const paymentId = button.getAttribute('data-payment-id');
                const deleteForm = document.querySelector(`#deleteForm${paymentId}`);

                Swal.fire({
                    title: 'CONFIRMATION MESSAGE',
                    text: 'Are you sure you want to delete this payment record?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit();
                    }
                });
            });
        });
    });

</script>

</x-layout>
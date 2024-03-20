<x-layout>
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Details</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payment.index')}}">Payments</a></li>
                        <li class="breadcrumb-item active">Payment Record # {{ $payment->PMT_ID }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Left Column - Order Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Information</h3>
                    </div>
                <div class="card-body" style="height: 300px"> 
                    <strong>{{ $selectedOrder->Order_ID }}</strong>
                    <hr>
                    <p class="text-muted">Insert Order Information here</p>
                    <!--TO DO: Add Order Information -->
                    <!--<p class="text-muted">{{ $selectedOrder->Phone_Number }}</p>-->
                </div>
                </div>
            </div>

            <!-- Right Column - Payment Details -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="post">
                        </div>

                        <form action="{{ route('payment.updatePayment', ['id' => $payment->PMT_ID]) }}" method="POST" class="p-3 rounded" id="payment-form">
                        @csrf
                        <div class="form-group row">
                            <label for="Order_ID" class="col-sm-3 col-form-label text-right">Order ID:</label>
                            <div class="col-sm-6">
                            <select name="Order_ID" id="Order_ID" class="form-control" disabled>
                            @foreach($orders as $id => $orderID)
                                <option value="{{ $id }}" @if($id == $payment->Order_ID) selected @endif>{{ $orderID }}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Date" class="col-sm-3 col-form-label text-right">Date:</label>
                            <div class="col-sm-6">
                                <input type="text" id="Date" name="Date" class="form-control" placeholder="Date" value="{{ $payment->Date->format('Y-m-d') }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="PMT_Cat" class="col-sm-3 col-form-label text-right">Payment Category:</label>
                            <div class="col-sm-6">
                                <select name="PMT_Cat" id="PMT_Cat" class="form-control" disabled>
                                    <option value="Product">Product</option>
                                    <option value="Freight">Freight</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Amount" class="col-sm-3 col-form-label text-right">Amount:</label>
                            <div class="col-sm-6">
                                <input type="text" id="Amount" name="Amount" class="form-control" placeholder="Amount" value="{{ number_format($payment->Amount, 2) }}" disabled>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="PMT_Type" class="col-sm-3 col-form-label text-right">Payment Type:</label>
                            <div class="col-sm-6">
                                <select name="PMT_Type_ID" id="PMT_Type_ID" class="form-control" disabled>
                                    @foreach($paymentTypes as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="Product_Name" class="col-sm-3 col-form-label text-right">Product:</label>
                            <div class="col-sm-6">
                                <select id="Product_Name" name="Product_Name" class="form-control" disabled>
                                 {{-- Product options will be added here dynamically --}}
                                </select>
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="Remarks" class="col-sm-3 col-form-label text-right">Remarks:</label>
                            <div class="col-sm-6">
                                <input type="text" id="Remarks" name="Remarks" class="form-control" placeholder="Example: Payment declined" value="{{ $payment->Remarks }}" disabled>
                            </div>
                        </div>  
                        
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-6">
                                <button type="submit" id="btnSave" class="btn btn-primary btn-fixed" style="display: none;">Save</button>
                                <button type="button" id="btnCancel" class="btn btn-default btn-fixed" style="display: none;" onclick="cancelEdit()">Cancel</button>
                                <button type="button" id="btnEdit" class="btn btn-primary btn-fixed" onclick="enableFields()">Edit</button>
                            </div>
                        </div>                      
                    <!--Hidden field to carry Order ID info-->
                    <input type="hidden" name="Order_ID" value="{{ $payment->Order_ID }}">
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    function enableFields() {
        document.getElementById('Order_ID').disabled = true;
        document.getElementById('Date').disabled = false;
        document.getElementById('PMT_Cat').disabled = false;
        document.getElementById('Amount').disabled = false;
        document.getElementById('PMT_Type_ID').disabled = false;
        document.getElementById('Product_Name').disabled = false;
        document.getElementById('Remarks').disabled = false;
        document.getElementById('btnSave').style.display = 'inline';
        document.getElementById('btnCancel').style.display = 'inline';
        document.getElementById('btnEdit').style.display = 'none';
    }

    function cancelEdit() {
        document.getElementById('Order_ID').disabled = true;
        document.getElementById('Date').disabled = true;
        document.getElementById('PMT_Cat').disabled = true;
        document.getElementById('Amount').disabled = true;
        document.getElementById('PMT_Type_ID').disabled = true;
        document.getElementById('Product_Name').disabled = true;
        document.getElementById('Remarks').disabled = true;
        document.getElementById('btnSave').style.display = 'none';
        document.getElementById('btnCancel').style.display = 'none';
        document.getElementById('btnEdit').style.display = 'inline';
    }
</script>

        <!-- Include SweetAlert2 library -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

</x-layout>

            
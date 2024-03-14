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

                        <form action="{{ route('updatePayment', ['id' => $payment->PMT_ID]) }}" method="POST" class="p-3 rounded" id="client-form">
                        @csrf
                        <div class="form-group row">
                            <label for="Order_ID" class="col-sm-3 col-form-label text-right">Order ID:</label>
                            <div class="col-sm-6">
                                <input type="text" id="Order_ID" name="Order_ID" class="form-control" placeholder="Order ID" value="{{ $payment->Order_ID }}" disabled>
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
                                <input type="text" id="PMT_Cat" name="PMT_Cat" class="form-control" placeholder="Payment Category" value="{{ $payment->PMT_Cat }}" disabled>
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
                                <input type="text" id="PMT_Type" name="PMT_Type" class="form-control" placeholder="Payment Type" value="{{ $payment->paymentType ? $payment->paymentType->PMT_Type_Name : 'N/A' }}" disabled>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="Product" class="col-sm-3 col-form-label text-right">Product:</label>
                            <div class="col-sm-6">
                                <input type="text" id="Product" name="Product" class="form-control" placeholder="Product" value="{{ $payment->products ? $payment->products->Product_Name : 'N/A' }}" disabled>
                            </div>
                        </div>  
                        
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-6">
                                <button type="submit" id="btnSave" class="btn btn-primary btn-fixed" style="display: none;">Save</button>
                                <button type="button" id="btnCancel" class="btn btn-default btn-fixed" style="display: none;" onclick="cancelEdit()">Cancel</button>
                                <button type="button" id="btnEdit" class="btn btn-primary btn-fixed" onclick="enableFields()">Edit</button>
                            </div>
                        </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    function enableFields() {
        document.getElementById('Order_ID').disabled = false;
        document.getElementById('Date').disabled = false;
        document.getElementById('PMT_Cat').disabled = false;
        document.getElementById('Amount').disabled = false;
        document.getElementById('PMT_Type').disabled = false;
        document.getElementById('Product').disabled = false;
        document.getElementById('btnSave').style.display = 'inline';
        document.getElementById('btnCancel').style.display = 'inline';
        document.getElementById('btnEdit').style.display = 'none';
    }

    function cancelEdit() {
        document.getElementById('Order_ID').disabled = true;
        document.getElementById('Date').disabled = true;
        document.getElementById('PMT_Cat').disabled = true;
        document.getElementById('Amount').disabled = true;
        document.getElementById('PMT_Type').disabled = true;
        document.getElementById('Product').disabled = true;
        document.getElementById('btnSave').style.display = 'none';
        document.getElementById('btnCancel').style.display = 'none';
        document.getElementById('btnEdit').style.display = 'inline';
    }
</script>

</x-layout>

            

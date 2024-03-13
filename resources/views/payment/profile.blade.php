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

    <!-- Payment Details Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Payment Details Card -->
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h3 class="profile-username text-center">Payment Record # {{ $payment->PMT_ID }}</h3>
                        <p class="text-muted text-center">Transaction Details</p>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Order ID</strong>
                                <p class="text-muted">{{ $payment->Order_ID }}</p>
                            </div>
                            <div class="col-sm-4">
                                <strong>Date</strong>
                                <p class="text-muted">{{ $payment->Date->format('Y-m-d') }}</p>
                            </div>
                            <div class="col-sm-4">
                                <strong>Payment Category</strong>
                                <p class="text-muted">{{ $payment->PMT_Cat }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Amount</strong>
                                <p class="text-muted">${{ number_format($payment->Amount, 2) }}</p>
                            </div>
                            <div class="col-sm-4">
                                <strong>Payment Type</strong>
                                <!-- Assuming PaymentType relation is defined in Payment model -->
                                <p class="text-muted">{{ $payment->paymentType ? $payment->paymentType->PMT_Type_Name : 'N/A' }}</p>
                            </div>
                            <div class="col-sm-4">
                                <strong>Product</strong>
                                <p class="text-muted">{{ $payment->products ? $payment->products->Product_Name : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                                <div class="col-12 text-center">
                                    <button type="" class="btn btn-primary btn-fixed ml-neg-5">Update</button>
                                    <!-- to do: create an action for Update -->
                                    <a href="{{ route('payment.index') }}" class="btn btn-default btn-fixed">Back</a>
                                </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<x-layout>
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Details</h1>
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
                                <p class="text-muted">{{ $payment->paymentType->PMT_Type_Name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<x-layout>
    <style>
        .ml-neg-5 { margin-left: -5rem; }
        .swal-custom-html-container ul { text-align: left; margin-left: 0; padding-left: 1.5em; }
        .card-title { font-size: 24px; font-weight: bold; }
        label { font-weight: bold; }
    </style>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa-solid fa-money-check-dollar mr-2"></i>Add Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payment.index')}}">Payments</a></li>
                        <li class="breadcrumb-item active">Add Payment</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('payment.store') }}">
                                @csrf
                                <div class="container">
                                    <div class="form-group">
                                        <label for="Order_ID">Order ID:</label>
                                        <select name="Order_ID" id="Order_ID" class="form-control">
                                            @foreach($orders as $id => $orderID)
                                                <option value="{{ $id }}" 
                                                    {{ (isset($selectedOrder) && $id == $selectedOrder->Order_ID) ? 'selected' : (old('Order_ID') == $id ? 'selected' : ($loop->first ? 'selected' : '')) }}>
                                                    {{ $orderID }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Invoice">Invoice Number:</label>
                                        <input type="text" name="Invoice" id="Invoice" class="form-control" placeholder="Enter QuickBooks Invoice Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="Date">Date:</label>
                                        <input type="date" name="Date" id="Date" class="form-control" placeholder="Enter Date">
                                    </div>

                                    <div class="form-group">
                                        <label for="PMT_Cat">Payment Category:</label>
                                        <select name="PMT_Cat" id="PMT_Cat" class="form-control">
                                            <option value="Product">Product</option>
                                            <option value="Freight">Freight</option>
                                        </select>
                                    </div>

                                    {{-- This div will contain the dropdown for products and will initially be hidden --}}
                                    <div id="product_dropdown" class="form-group" style="display: none;">
                                        <label for="Product_Name">Product:</label>
                                        <select id="Product_Name" name="Product_Name" class="form-control">
                                            {{-- Product options will be added here dynamically --}}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Amount">Amount:</label>
                                        <input type="text" name="Amount" id="Amount" class="form-control" placeholder="Enter Amount">
                                    </div>

                                    <div class="form-group">
                                        <label for="PMT_Type_Name">Payment Type:</label>
                                        <select name="PMT_Type_ID" id="PMT_Type_ID" class="form-control">
                                            @foreach($paymentTypes as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Remarks">Remarks:</label>
                                        <input type="text" name="Remarks" id="Remarks" class="form-control" placeholder="Example: Payment Successful">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-fixed ml-neg-5">Save</button>
                                        <a href="{{ route('payment.index') }}" class="btn btn-default btn-fixed">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

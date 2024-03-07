<x-layout>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Payment</h1>
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
                <!-- Offset to align with the title, adjust 'col-md-offset-*' as needed -->
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="{{ route('payment.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="Order_ID">Order ID:</label>
                            <select name="Order_ID" id="Order_ID" class="form-control">
                                @foreach($orders as $id => $orderID)
                                    <option value="{{ $id }}">{{ $orderID }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Date">Date:</label>
                            <input type="date" name="Date" id="Date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="PMT_Cat">Payment Category:</label>
                            <select name="PMT_Cat" id="PMT_Cat" class="form-control">
                                <option value="Product">Product</option>
                                <option value="Freight">Freight</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Amount">Amount:</label>
                            <input type="text" name="Amount" id="Amount" class="form-control" placeholder="$0.00">
                        </div>

                        <div class="form-group">
                            <label for="PMT_Type_Name">Payment Type:</label>
                            <select name="PMT_Type_ID" id="PMT_Type_ID" class="form-control">
                                @foreach($paymentTypes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>

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
    </section>

        <!-- Include SweetAlert2 library -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Check for the 'success' session variable and display a SweetAlert -->
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Good job!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

</x-layout>

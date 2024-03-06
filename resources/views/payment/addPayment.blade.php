@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Payment</h2>

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
            <select name="PMT_Type_Name" id="PMT_Type_Name" class="form-control">
                @foreach($paymentTypes as $id => $type)
                    <option value="{{ $id }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Payment</button>
    </form>
</div>
@endsection

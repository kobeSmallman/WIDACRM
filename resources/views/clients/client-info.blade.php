<x-layout> 

    <style>
        .ml-neg-5 {
            margin-left: -5rem; 
        }

        .swal-custom-html-container ul {
            text-align: left;
            margin-left: 0;
            padding-left: 1.5em;
        }

    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('clients') }}">Clients</a></li>
                        <li class="breadcrumb-item active">Client Information</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-4">


        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Client Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="height: 300px"> 
                <strong>{{ $selectedClient->Company_Name }}</strong>
                <hr>
                <p class="text-muted">{{ $selectedClient->Shipping_Address }}</p>
                <p class="text-muted">{{ $selectedClient->Phone_Number }}</p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Contact Details</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Order History</a></li> 
            </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post"> 
                </div>
                <!-- /.post -->

                <form action="{{ route('updateClient', ['id' => $selectedClient->Client_ID]) }}" method="POST" class="p-3 rounded" id="client-form">
                @csrf
                <!-- Form fields -->
                    <!-- <div class="form-group row">
                    <label for="Company_Name" class="col-sm-3 col-form-label text-right">Company Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Company_Name" id="Company_Name" placeholder="Company Name" required>
                    </div>
                </div>  -->
                <div class="form-group row">
                    <label for="Main_Contact" class="col-sm-3 col-form-label text-right">Main Contact:</label>
                    <div class="col-sm-6">
                        <input type="text" id="Main_Contact" name="Main_Contact" class="form-control" placeholder="Main Contact" value="{{ $selectedClient->Main_Contact }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Shipping_Address" class="col-sm-3 col-form-label text-right">Shipping Address:</label>
                    <div class="col-sm-6">
                        <input type="text" id="Shipping_Address" name="Shipping_Address" class="form-control" placeholder="Shipping Address" value="{{ $selectedClient->Shipping_Address }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Billing_Address" class="col-sm-3 col-form-label text-right">Billing Address:</label>
                    <div class="col-sm-6">
                        <input type="text" id="Billing_Address" name="Billing_Address" class="form-control" placeholder="Billing Address" value="{{ $selectedClient->Billing_Address }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Email" class="col-sm-3 col-form-label text-right">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" id="Email" name="Email" class="form-control" placeholder="Email" value="{{ $selectedClient->Email }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Phone_Number" class="col-sm-3 col-form-label text-right">Phone Number:</label>
                    <div class="col-sm-6">
                        <input type="text" id="Phone_Number" name="Phone_Number" class="form-control" placeholder="Phone Number" value="{{ $selectedClient->Phone_Number }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Lead_Status" class="col-sm-3 col-form-label text-right">Lead Status:</label>
                    <div class="col-sm-6">
                        <select id="Lead_Status" name="Lead_Status" class="form-control" disabled>
                            <option value="ACTIVE" {{ $selectedClient->Lead_Status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                            <option value="INACTIVE" {{ $selectedClient->Lead_Status == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Buyer_Status" class="col-sm-3 col-form-label text-right">Buyer Status:</label>
                    <div class="col-sm-6">
                        <select id="Buyer_Status" name="Buyer_Status" class="form-control" disabled>
                            <option value="ACTIVE" {{ $selectedClient->Buyer_Status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                            <option value="INACTIVE" {{ $selectedClient->Buyer_Status == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                        </select>
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
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">  
                    <table id="tblOrderHistory" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Remarks</th>
                                <th>Order Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderHistory as $order)
                            <tr>
                                <td>{{ $order->Order_ID }}</td> 
                                <td>{{ $order->Order_Date }}</td> 
                                <td>{{ $order->Remarks }}</td> 
                                <td>{{ $order->Order_Status }}</td>  
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
                <!-- /.tab-pane --> 
            </div>
            <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->  
    
</x-layout> 

<script>

$(document).ready(function() {    
    $("#tblOrderHistory").DataTable({
        "pageLength": 5,
        "aaSorting": [],
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,  
    }).buttons().container().appendTo('#tblOrderHistory_wrapper .col-md-6:eq(0)');
   
});


    function enableFields() {
        document.getElementById('Main_Contact').disabled = false;
        document.getElementById('Shipping_Address').disabled = false;
        document.getElementById('Billing_Address').disabled = false;
        document.getElementById('Email').disabled = false;
        document.getElementById('Phone_Number').disabled = false;
        document.getElementById('Lead_Status').disabled = false;
        document.getElementById('Buyer_Status').disabled = false;
        document.getElementById('btnSave').style.display = 'inline';
        document.getElementById('btnCancel').style.display = 'inline';
        document.getElementById('btnEdit').style.display = 'none';
    }

    function cancelEdit() {
        document.getElementById('Main_Contact').disabled = true;
        document.getElementById('Shipping_Address').disabled = true;
        document.getElementById('Billing_Address').disabled = true;
        document.getElementById('Email').disabled = true;
        document.getElementById('Phone_Number').disabled = true;
        document.getElementById('Lead_Status').disabled = true;
        document.getElementById('Buyer_Status').disabled = true;
        document.getElementById('btnSave').style.display = 'none';
        document.getElementById('btnCancel').style.display = 'none';
        document.getElementById('btnEdit').style.display = 'inline';


        document.getElementById('Main_Contact').value = "{{ $selectedClient->Main_Contact }}";
        document.getElementById('Shipping_Address').value = "{{ $selectedClient->Shipping_Address }}";
        document.getElementById('Billing_Address').value = "{{ $selectedClient->Billing_Address }}";
        document.getElementById('Email').value = "{{ $selectedClient->Email }}";
        document.getElementById('Phone_Number').value = "{{ $selectedClient->Phone_Number }}"; 


        var leadStatus = "{{ $selectedClient->Lead_Status }}".toUpperCase();;
        var buyerStatus = "{{ $selectedClient->Buyer_Status }}".toUpperCase();; 

        var leadStatusSelect = document.getElementById('Lead_Status');
        for (var i = 0; i < leadStatusSelect.options.length; i++) {
            if (leadStatusSelect.options[i].value === leadStatus) {
                leadStatusSelect.options[i].selected = true;
                break;
            }
        }
 
        var buyerStatusSelect = document.getElementById('Buyer_Status');
        for (var j = 0; j < buyerStatusSelect.options.length; j++) {
            if (buyerStatusSelect.options[j].value === buyerStatus) {
                buyerStatusSelect.options[j].selected = true;
                break;
            }
        }
    }
</script>
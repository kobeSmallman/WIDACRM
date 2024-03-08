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
                <h3 class="card-title">Client Name</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
  
                    <!-- Form fields -->
                    <div class="form-group row">
                        <label for="Company_Name" class="col-sm-3 col-form-label text-right ml-neg-5">Company Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="Company_Name" id="Company_Name" placeholder="Company Name" required>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="Main_Contact" class="col-sm-3 col-form-label text-right ml-neg-5">Main Contact:</label>
                        <div class="col-sm-6">
                            <input type="text" id="Main_Contact" name="Main_Contact" class="form-control" placeholder="Main Contact">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Shipping_Address" class="col-sm-3 col-form-label text-right ml-neg-5">Shipping Address:</label>
                        <div class="col-sm-6">
                            <input type="text" id="Shipping_Address" name="Shipping_Address" class="form-control" placeholder="Shipping Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Billing_Address" class="col-sm-3 col-form-label text-right ml-neg-5">Billing Address:</label>
                        <div class="col-sm-6">
                            <input type="text" id="Billing_Address" name="Billing_Address" class="form-control" placeholder="Billing Address">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="Email" class="col-sm-3 col-form-label text-right ml-neg-5">Email:</label>
                        <div class="col-sm-6">
                            <input type="email" id="Email" name="Email" class="form-control"  placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Phone_Number" class="col-sm-3 col-form-label text-right ml-neg-5">Phone Number:</label>
                        <div class="col-sm-6">
                            <input type="text" id="Phone_Number" name="Phone_Number" class="form-control"  placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Lead_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Lead Status:</label>
                        <div class="col-sm-6">
                            <input type="text" id="Lead_Status" name="Lead_Status" class="form-control" placeholder="Lead Status" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Buyer_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Buyer Status:</label>
                        <div class="col-sm-6">
                            <input type="text" id="Buyer_Status" name="Buyer_Status" class="form-control" placeholder="Buyer Status" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-6">
                            <button type="submit" id="btnSave" class="btn btn-primary btn-fixed ml-neg-5">Save</button>
                            <a href="{{ route('clients') }}" class="btn btn-default btn-fixed">Cancel</a>
                        </div>
                    </div> 

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
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Orders</a></li> 
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      
                    </div>
                    <!-- /.post -->

                    
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    
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
<x-layout>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Error 403</h1>
            </div> 
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Error 403</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid"> 
    <div class="card">
    <div class="error-page">
        <h2 class="headline text-primary" style="margin-right: 15px"> 403</h2> 

        <div class="error-content mt-3">
          <h3><i class="fas fa-exclamation-triangle text-primary"></i> Oops! Access denied.</h3>

          <p>
            Sorry but you do not have permission to access this page.
            Meanwhile, you may  <a href="{{ (auth()->user()->Role_ID == 1) ? route('admin.dashboard') : route('employee.dashboard') }}" >return to dashboard.</a>
          </p> 
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </div>
</div>    

</x-layout>

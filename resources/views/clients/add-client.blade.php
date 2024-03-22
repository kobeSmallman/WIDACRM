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
                        <li class="breadcrumb-item active">Client Registration</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">  
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header"> 
                        <h3 class="card-title"><i class="fa-solid fa-user-plus mr-2"></i>Client Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.saveClient') }}" method="POST" class="p-3 rounded" id="client-form">
                            @csrf
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
                                    <select id="Lead_Status" name="Lead_Status" class="form-control">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Buyer_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Buyer Status:</label>
                                <div class="col-sm-6">
                                    <select id="Buyer_Status" name="Buyer_Status" class="form-control">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                </div>
                            </div>
                            
                           
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-6">
                                    <button type="submit" id="btnSave" class="btn btn-primary btn-fixed ml-neg-5">Save</button>
                                    <a href="{{ route('clients') }}" class="btn btn-default btn-fixed">Cancel</a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layout>
<script>
    document.addEventListener('input', function(event) {
        if ((event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') && event.target.type !== 'email') {
            event.target.value = event.target.value.toUpperCase();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('client-form');
        const submitBtn = document.getElementById('btnSave');

        // SUBMIT CONFIRMATION
        form.addEventListener('submit', function(event) {
            event.preventDefault(); 
            Swal.fire({
                title: 'CONFIRMATION MESSAGE',
                text: 'Do you want to save this new client?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) { 
                    form.submit(); 
                }
            });
        }); 

        // Check if validation errors exist and display them
        const validationErrors = @json($errors->all());
        if (validationErrors.length > 0) {
            let errorMessage = '';
            if (validationErrors.length > 1) {
                errorMessage += '<ul>';
                validationErrors.forEach(error => {
                    errorMessage += `<li>${error}</li>`;
                });
                errorMessage += '</ul>';
            } else {
                errorMessage = validationErrors[0];
            }

            Swal.fire({
                title: 'WARNING MESSAGE',
                html: errorMessage,
                icon: 'warning',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal-custom-popup',
                    htmlContainer: 'swal-custom-html-container'
                }
            });
        }
 

    });


</script>
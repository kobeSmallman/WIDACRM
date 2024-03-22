<x-layout> 

    <style> 
        .circle-img {
            width: 150px;
            height: 150px;
            overflow: hidden;
        }

        .circle-img img {
            height: 100%;
            transform: translateX(-50%);
            margin-left: 50%;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('permissions')}}">Permissions</a></li>
                        <li class="breadcrumb-item active">Employee Permissions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row"> 
            <div class="col-md-4"> 
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center"> 
                            @if ($selectedEmployee->profile_image)
                            <img class="circle-img profile-user-img img-fluid img-circle"
                                src="data:image/jpeg;base64,{{ $selectedEmployee->profile_image }}" alt="User profile picture">
                            @else
                                <div class="circle-img profile-image profile-user-img img-fluid img-circle" style="font-size: 80px;"> 
                                    <i class="fa-solid fa-user"></i>  
                                </div>
                            @endif 
                        </div>
 
                        <h3 class="profile-username text-center">
                            {{ $selectedEmployee->First_Name }} 
                            {{ $selectedEmployee->Last_Name }} 
                        </h3>
                        <p class="text-muted text-center">{{ $selectedEmployee->Position }}</p>
                        <hr>
                            Department
                        <p class="text-muted">{{ $selectedEmployee->Department }}</p>
                            Employee Status
                        <p class="text-muted">{{ $selectedEmployee->Employee_Status }}</p> 
                         
                    </div>
                </div>
            </div>

            <!-- Right column  -->
            <div class="col-md-8">
                <!-- Profile Details Card -->
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills justify-content-between">
                            <li class="nav-item" id="tabHeaderPermissions"><a class="nav-link active" href="#tabPermissions" data-toggle="tab">Employee Permissions</a></li>
                            <li class="nav-item" id="tabHeaderNew"><a class="nav-link" href="#tabNew" data-toggle="tab">New Permission</a></li> 
                            <li class="nav-item" id="tabHeaderModify"><a class="nav-link" href="#tabModify" data-toggle="tab">Modify Permission</a></li> 
                            
                            <button type="button" id="btnAdd" class="btn btn-primary btn-fixed float-right">Add</button>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="tabPermissions">  
                                <table id="tblEmpPermissions" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Manage</th>
                                            <th>Page</th>
                                            <th>Full Access</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($employeePermissions as $permission)
                                            <tr>
                                                <td> 
                                                    <!-- Edit -->  
                                                    <a class="btn btn-default btn-sm edit-permission" 
                                                        data-permission-id="{{ $permission->Permission_ID }}" 
                                                        data-page-name="{{ $permission->page->Page_Name }}" 
                                                        data-page-id="{{ $permission->Page_ID }}" 
                                                        data-full-control="{{ $permission->Full_Control }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>

                                                    <!-- Delete -->  
                                                    <form id="deleteForm{{ $permission->Permission_ID }}" action="{{ route('permissions.delete', $permission->Permission_ID) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-default btn-sm delete-btn" data-permission-id="{{ $permission->Permission_ID }}">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ $permission->page->Page_Name }}</td>
                                                <td>
                                                    @if($permission->Full_Control == 1)
                                                        FULL ACCESS
                                                    @else
                                                        VIEW ONLY
                                                    @endif
                                                </td> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> 

                            </div>
                            <!-- /.tab-pane -->  

                            <div class="tab-pane" id="tabNew"> 

                                <form class="p-3 rounded" id="permissionForm">
                                    @csrf 
                                    <input type="hidden" name="Employee_ID" id="Employee_ID"  value="{{ $selectedEmployee->Employee_ID }}"> 
                                    <div class="form-group row">
                                        <label for="Page_ID" class="col-sm-3 col-form-label text-right">Page:</label>
                                        <div class="col-sm-6">
                                            <select id="Page_ID" name="Page_ID" class="form-control">
                                                @foreach($pages as $page)
                                                    <option value="{{ $page->Page_ID }}">{{ $page->Page_Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="Full_Control" class="col-sm-3 col-form-label text-right">Access:</label>
                                        <div class="col-sm-6">
                                            <select id="Full_Control" name="Full_Control" class="form-control">
                                                <option value="1">FULL</option>
                                                <option value="0">VIEW ONLY</option> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-6">
                                            <button type="submit" id="btnSave" class="btn btn-primary btn-fixed">Save</button>
                                            <button type="button" id="btnCancel" class="btn btn-default btn-fixed">Cancel</button>
                                        </div>
                                    </div> 
                                </form>

                            
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tabModify"> 

                                <form action="{{ route('permissions.update') }}" method="POST" class="p-3 rounded">
                                    @csrf 
                                    @method('PUT')
                                      
                                    <input type="hidden" name="Permission_ID2" id="Permission_ID2"> 
                                    <input type="hidden" name="Employee_ID2" id="Employee_ID2"  value="{{ $selectedEmployee->Employee_ID }}"> 
                                    <input type="hidden" name="Page_ID2" id="Page_ID2"> 

                                    <div class="form-group row">
                                        <label for="Page_ID3" class="col-sm-3 col-form-label text-right">Page:</label> 
                                        <div class="col-sm-6">
                                            <input type="text" id="Page_ID3" name="Page_ID3" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Full_Control2" class="col-sm-3 col-form-label text-right">Access:</label>
                                        <div class="col-sm-6">
                                            <select id="Full_Control2" name="Full_Control2" class="form-control">
                                                <option value="1">FULL</option>
                                                <option value="0">VIEW ONLY</option> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-6">
                                            <button type="submit" id="btnSaveUpdate" class="btn btn-primary btn-fixed">Save</button>
                                            <button type="button" id="btnCancelUpdate" class="btn btn-default btn-fixed">Cancel</button>
                                        </div>
                                    </div> 
                                </form>

                            
                            </div>
                            <!-- /.tab-pane -->
                            
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>    
</x-layout> 


@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'INFORMATION MESSAGE',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif  



<script>
    $(document).ready(function() {
        // Hide the "New Permission" tab initially
        $('#tabHeaderNew').hide();
        $('#tabHeaderModify').hide();

        // Click event handler for the "Add" button
        $('#btnAdd').click(function() { 
            $('#tabHeaderPermissions').find('a').removeClass('active');
            $('#tabPermissions').removeClass('active'); 
            $('#tabHeaderPermissions').hide();
 
            // Show and set "New Permission" tab as active 
            $('#tabHeaderNew').find('a').addClass('active');
            $('#tabNew').addClass('active');
            $('#tabHeaderNew').show();
 

            $('#Full_Control').val(''); 
            $('#Page_ID').val('');

            // Hide "Add" button 
            $(this).hide(); 
        });


        $('#btnCancel').click(function() { 
            $('#tabHeaderNew').find('a').removeClass('active');
            $('#tabHeaderNew').hide();
            $('#tabNew').removeClass('active'); 
  
            $('#tabHeaderPermissions').find('a').addClass('active');
            $('#tabHeaderPermissions').show();
            $('#tabPermissions').addClass('active');
 
            $('#btnAdd').show();
            $('#Page_ID').val('');
            $('#Full_Access').val('');
        });


        const form = document.getElementById('client-form');
        const submitBtn = document.getElementById('btnSave');

 

        $('#btnSave').click(function(e) {
            e.preventDefault();  


            Swal.fire({
                title: 'CONFIRMATION MESSAGE',
                text: 'Do you want to save this new permission?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) { 
                   
                    var formData = $('#permissionForm').serialize();   
                    $.ajax({
                        url: '{{ route("permissions.save") }}',
                        type: 'POST',  
                        data: formData,  
                        success: function(response) { 
 
                            Swal.fire({
                                title: 'INFORMATION MESSAGE',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
 
                            location.reload();
                        },
                        error: function(xhr, status, error) { 
                            console.error(xhr.responseText);
                            var errors = JSON.parse(xhr.responseText);
                            var errorMessage = '';

                            if (errors && errors.errors) {
                                // validation errors
                                Object.values(errors.errors).forEach(function(error) {
                                    errorMessage += '<li>' + error[0] + '</li>';
                                });
                            } else { 
                                errorMessage = 'An error occurred while processing your request. Please try again later.';
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
 
                }
            });

            
        });


        $('.edit-permission').click(function(e) {
            e.preventDefault();

            var permissionId = $(this).data('permission-id');
            var pageName = $(this).data('page-name');
            var pageId = $(this).data('page-id');
            var fullControl = $(this).data('full-control');

            console.log(pageId);
            console.log(permissionId + pageName + fullControl);
            // Set values in the Modify Permission tab
            $('#tabHeaderPermissions').find('a').removeClass('active');
            $('#tabPermissions').removeClass('active'); 
            $('#tabHeaderPermissions').hide();
 
            // Show and set "Modify Permission" tab as active 
            $('#tabHeaderModify').find('a').addClass('active');
            $('#tabModify').addClass('active');
            $('#tabHeaderModify').show();

            $('#Permission_ID2').val(permissionId); 
            $('#Page_ID2').val(pageId); 
            $('#Page_ID3').val(pageName); 
            $('#Full_Control2').val(fullControl);
 
            $('#btnAdd').hide();
        });

        $('#btnCancelUpdate').click(function(e) { 

            $('#tabHeaderModify').find('a').removeClass('active');
            $('#tabHeaderModify').hide();
            $('#tabModify').removeClass('active'); 
  
            $('#tabHeaderPermissions').find('a').addClass('active');
            $('#tabHeaderPermissions').show();
            $('#tabPermissions').addClass('active');
  
            $('#btnAdd').show();
            $('#Permission_ID2').val(''); 
            $('#Page_ID2').val('');
            $('#Page_ID3').val('');
            $('#Full_Control2').val('');

        });

       
    });

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const permissionId = button.getAttribute('data-permission-id');
                const deleteForm = document.querySelector(`#deleteForm${permissionId}`);

                Swal.fire({
                    title: 'CONFIRMATION MESSAGE',
                    text: 'Do you want to delete this permission?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit();
                    }
                });
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
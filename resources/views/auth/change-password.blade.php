
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WIDACRM | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html" hidden><b>WIDA</b>CRM</a>
    <img src="https://i.postimg.cc/XJwytTdC/Screenshot-2024-02-14-at-1-30-18-PM.png" 
        width="360" style="margin-bottom: -13px" />
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Change Password Utility</p>

        <!-- Display Error Message -->
        @if($errors->any())
            <div class="alert alert-danger">
          
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach 
            </div>
        @endif


      <form action="{{ route('auth.loginNewPwd') }}" method="POST">
        @csrf <!-- CSRF token is required for form submission -->
        
        <div class="input-group mb-3">
          <input type="hidden" name="Employee_ID" value="{{ $employeeID }}"> 
        </div> 
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="New Password" id="newpassword" name="newpassword" required>
          <div class="input-group-append">
            <div class="input-group-text" id="togglePassword2">
              <span class="fas fa-eye-slash"></span>
            </div>
            
          </div>
        </div>
 
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Re-type New Password" id="renewpassword" name="renewpassword" required>
          <div class="input-group-append">
            <div class="input-group-text" id="togglePassword3">
              <span class="fas fa-eye-slash"></span>
            </div>
            
          </div>
        </div>

        <div class="row">
          <div class="col-8">

          </div> 
          <div class="col-12 text-center mb-3">
            <button type="submit" class="btn btn-primary btn-block" >Save</button>
          </div> 
        </div>
      </form>
 
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Script to toggle password visibility -->
<script>
  $(document).ready(function() { 
    $('#togglePassword2').click(function() { 
      const password = $('#newpassword');
      const icon = $(this).find('span');
 
      if (password.attr('type') === 'password') { 
        password.attr('type', 'text'); 
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
      } else { 
        password.attr('type', 'password'); 
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
      }
    });

    $('#togglePassword3').click(function() { 
      const password = $('#renewpassword');
      const icon = $(this).find('span');
 
      if (password.attr('type') === 'password') { 
        password.attr('type', 'text'); 
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
      } else { 
        password.attr('type', 'password'); 
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
      }
    });
  });
</script>

</body>
</html>


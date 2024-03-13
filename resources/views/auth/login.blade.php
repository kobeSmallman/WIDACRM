
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
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login') }}" method="POST">
        @csrf <!-- CSRF token is required for form submission -->
        
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Employee ID" id="Employee_ID" name="Employee_ID" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
          <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <span class="fas fa-eye-slash" aria-hidden="true"></span>
          </button>
<!--             <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div> -->
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember" hidden>
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 text-center mb-3">
            <button type="submit" class="btn btn-primary btn-block" >Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3" hidden>
        <p hidden>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2" hidden></i> 
          Sign in 
        </a>
        <a href="#" class="btn btn-block btn-danger" hidden>
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1" hidden>
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0" hidden>
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Script to toggle password visibility -->
<script>
  $(document).ready(function() {
    // Listen for a click on the togglePassword button
    $('#togglePassword').click(function() {
      // Select the password input field and the icon inside the button
      const password = $('#password');
      const icon = $(this).find('span');

      // Check the type of the password field
      if (password.attr('type') === 'password') {
        // Change the password field to text
        password.attr('type', 'text');
        // Switch the icon to an open eye
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
      } else {
        // Change the text field back to password
        password.attr('type', 'password');
        // Switch the icon to a slashed eye
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
      }
    });
  });
</script>

</body>
</html>


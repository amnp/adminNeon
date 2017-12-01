<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
   
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>
  <div class="login-page">
  <div class="form">
    <form class="register-form" action="<?php echo base_url(); ?>index.php/adminneon_c/login_user" method="post">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="<?php echo base_url(); ?>index.php/adminneon_c/login_user" method="post">
      <input type="text" placeholder="username" name="admin_firstname"/>
      <input type="password" placeholder="password" name="admin_password"/>
      <button>login</button>
      <!--<p class="message">Not registered? <a href="#">Create an account</a></p>-->
    </form>
  </div>
</div>

    <script  src="js/index.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales and Inventory System</title>

    <!-- Bootstrap -->
    <link href="css_new/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css_new/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="css_nes/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method ="POST" action ="login.php">
              <h1>Administrator Login</h1>
              <div><input type="text" name = "username" class="form-control" placeholder="Username" required="true" /></div>
              <div><input type="password" name = "password" class="form-control" placeholder="Password" required="true" /></div>
              <div><button  class="btn btn-block btn-warning" name = "login"> Log in</button></div>

              <div class="clearfix"></div>
              <div class="separator">
              <div class="clearfix"></div>
              <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Sales and Inventory System </h1>
                  <p>© <?php echo date('Y');?> All Rights Reserved SMS(AHAD)</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

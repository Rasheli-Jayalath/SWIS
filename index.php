<?php

require_once("config/config.php");
/*require_once("requires/Database.php");
$obj= new Database();*/
$objCommon     = new Common;
$objMenu     = new Menu;
$objNews     = new News;
$objContent   = new Content;
$objTemplate   = new Template;
$objMail     = new Mail;
$objCustomer   = new Customer;
$objCart   = new Cart;
$objAdminUser   = new AdminUser;
$objProduct   = new Product;
$objValidate   = new Validate;
$objOrder     = new Order;
$objLog     = new Log;
require_once('rs_lang.admin.php');
require_once('rs_lang.website.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SMEC Water Information System</title>
  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css" integrity="sha512-kb1CHTNhoLzinkElTgWn246D6pX22xj8jFNKsDmVwIQo+px7n1yjJUZraVuR/ou6Kmgea4vZXZeUDbqKtXkEMg==" crossorigin="anonymous" /> -->

  <link rel="stylesheet" href="css/theRoot.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.6/responsive.bootstrap4.min.css" integrity="sha512-WHTjB8sZaxMigY+vKKakdKMijZOkGZQvIb9XFxf9Su4E+vjEITujzLC2NDzg12YnwMcfeELEolzdL0kxjzraAQ==" crossorigin="anonymous" />

  <script src="https://kit.fontawesome.com/93820ac793.js" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

  <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

</head>

<body class="d-flex flex-column">
  <?php
  if ($objAdminUser->is_login == true) {
    include("includes/menu.php");
  }
  ?>
  <section id="main">

    <?php if ($_GET['p'] == "logout") {
      require_once("./pages/logout.php");
    }

    if (isset($_GET['forgot']) && $_GET['forgot'] == "forgot") {
      require_once("pages/forgot.passwd.php");
    } else {
      if ($objAdminUser->is_login == true) {

        require_once("pages/default.php");
      } else {
        $refurl = $_SERVER['QUERY_STRING'];
        require_once("pages/login-form.php");
      }
    }
    ?>
  </section>
  <?php
  if ($objAdminUser->is_login == true) {
    include("includes/footer.php");
  }
  ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lozad.js/1.16.0/lozad.min.js" integrity="sha512-21jyjW5+RJGAZ563i/Ug7e0AUkY7QiZ53LA4DWE5eNu5hvjW6KUf9LqquJ/ziLKWhecyvvojG7StycLj7bT39Q==" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-responsive/2.2.6/dataTables.responsive.min.js" integrity="sha512-7XcGmBWR0h9TU3bAufG0jm8yKoEIHj+MLf4KvXG2FTUf2fP1rlX+c9VAsKlLCBTDp3yW0Fqo1Ix4RM3Sx1xldw==" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.6/responsive.bootstrap4.min.js" integrity="sha512-OiHNq9acGP68tNJIr1ctDsYv7c2kuEVo2XmB78fh4I+3Wi0gFtZl4lOi9XIGn1f1SHGcXGhn/3VHVXm7CYBFNQ==" crossorigin="anonymous"></script>

  <script src="js/theRoot.js" type="module"></script>

</body>

</html>
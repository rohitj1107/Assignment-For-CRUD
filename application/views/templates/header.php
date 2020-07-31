<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if($this->session->userdata('logged_in')){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Demo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <?php echo link_tag('//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'); ?>
  <link href="<?php print HTTP_CSS_PATH; ?>style.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="https://webdamn.com/wp-content/themes/v2/webdamn.png">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-default static-top" style="background-color:#d6dbdf!important">
  <div class="container">
    <?php echo $this->session->userdata('email'); ?> <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger">Logout</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	</button>
  </div>
</nav>
<?php } else { ?>

  <?php return redirect('login'); ?>

<?php } ?>

<!DOCTYPE html>
<html>
  <head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login | Aprende Palabra
    </title>
    <?= $this->Html->meta('icon') ?>

    <!--?= $this->Html->css('base.css') ?-->
    <!--?= $this->Html->css('style.css') ?-->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Font Awesome -->
    <?= $this->Html->css('all.min.css') ?>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <?= $this->Html->css('icheck-bootstrap.min.css') ?>
    <!-- Theme style -->
    <?= $this->Html->css('adminlte.min.css') ?>
    <?= $this->Html->css('last.css') ?>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition login-page">
    <?= $this->fetch('content') ?>

    <!-- jQuery -->
    <?= $this->Html->script('jquery.min.js') ?>
    <!-- Bootstrap 4 -->
    <?= $this->Html->script('bootstrap.bundle.min.js') ?>
    <!-- AdminLTE App -->
    <?= $this->Html->script('adminlte.min.js') ?>
  </body>
</html>
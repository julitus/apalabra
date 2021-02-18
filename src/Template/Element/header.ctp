<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <span class="nav-link"><?= $this->request->session()->read('Auth.User.name').' ('.$this->request->session()->read('Auth.User.username').')' ?></span>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" data-toggle="modal" data-target="#modal-edit-profile" href="#">
        <i class="fas fa-user"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" data-toggle="modal" data-target="#modal-change-pass" href="#">
        <i class="fas fa-lock"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
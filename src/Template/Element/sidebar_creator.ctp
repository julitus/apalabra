<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-warning elevation-4">
  <!-- Brand Logo -->
  <?= $this->Html->image('logo.png', ['class' => 'brand-link navbar-dark']); ?>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?= $this->Html->image('user.png', ['class' => 'img-circle elevation-2']); ?>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->request->session()->read('Auth.User.username') ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <?= $this->Html->link(__('<i class="nav-icon fas fa-book-open"></i> <p>Desafíos</p>'), ['controller' => 'Challenges', 'action' => 'index'], ['id' => 'apal-challenges', 'class' => 'nav-link', 'escape' => false]) ?>
        </li>
        <li class="nav-item">
          <?= $this->Html->link(__('<i class="nav-icon fas fa-sign-out-alt"></i> <p>Cerrar Sesión</p>'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link', 'escape' => false]) ?>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-warning elevation-4">
  <!-- Brand Logo -->
  <?= $this->Html->image('logo.png', ['class' => 'brand-link navbar-dark']); ?>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <?= $this->Html->link(__('<i class="nav-icon fas fa-book-open"></i> <p>Desafíos</p>'), ['controller' => 'Challenges', 'action' => 'index'], ['id' => 'apal-challenges', 'class' => 'nav-link', 'escape' => false]) ?>
        </li>
        <li class="nav-item">
          <?= $this->Html->link(__('<i class="nav-icon fas fa-book-reader"></i> <p>Jugadores Registrados</p>'), ['controller' => 'Connections', 'action' => 'index'], ['id' => 'apal-connections', 'class' => 'nav-link', 'escape' => false]) ?>
        </li>
        <li class="nav-item">
          <?= $this->Html->link(__('<i class="nav-icon fas fa-history"></i> <p>Historial de Juego</p>'), ['controller' => 'Records', 'action' => 'history'], ['id' => 'apal-records', 'class' => 'nav-link', 'escape' => false]) ?>
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
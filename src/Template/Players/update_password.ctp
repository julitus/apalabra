<!-- Content Header (Page header) -->
<section class="content-header apal-page" data-sidebar="players">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Actualizar Contraseña</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><?= $this->Html->link(__('Jugadores'), ['action' => 'index'], ['escape'=>false]) ?></li>
          <li class="breadcrumb-item active">Actualizar Contraseña</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline">
              
              <div class="card-header">
                <h3 class="card-title">Actualizar Contraseña: <?= $player->email ?></h3>
              </div>

              <?= $this->Form->create($player) ?>
                <div class="card-body">
                  <div class="form-group">
                    <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Nueva Contraseña', 'minlength' => 6, 'placeholder' => 'mín. 6 caracteres.', 'value' => '']) ?>
                  </div>
                </div>

                <div class="card-footer">
                  <?= $this->Form->button(__('Actualizar'), ['class' => 'btn btn-info float-right']) ?>
                  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                </div>
              <?= $this->Form->end() ?>

            </div>

        </div>
    </div>
  </div>
</section>
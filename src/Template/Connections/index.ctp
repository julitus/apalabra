<!-- Content Header (Page header) -->
<section class="content-header apal-page" data-sidebar="connections">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Jugadores Registrados</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Jugadores Registrados</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?php
  $status = $this->Global->status();
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Lista de Jugadores Registrados
                    </h3>

                    <div class="card-tools">
                      <?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Connections', 'action' => 'index'], 'role' => 'form']) ?>
                        <div class="input-group input-group-sm search-tool">
                          <input type="text" name="search" value="<?= $search ?>" class="form-control float-right" placeholder="Buscar... nombre, apellido o email">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      <?= $this->Form->end() ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Players.firstname', 'Nombres') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Players.lastname', 'Apellidos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Players.email', 'Email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('attemps', 'N° Intentos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('active', 'Estado') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created', 'Creado') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified', 'Actualizado') ?></th>
                                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody class="tbody-xs">
                            <?php foreach ($connections as $connection): ?>
                                <tr>
                                    <td><?= h($connection->player->firstname) ?></td>
                                    <td><?= h($connection->player->lastname) ?></td>
                                    <td><?= h($connection->player->email) ?></td>
                                    <td><?= $this->Number->format($connection->attemps) ?></td>
                                    <td><?= $status[$connection->active] ?></td>
                                    <td><?= h($connection->created->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td><?= h($connection->modified->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td class="actions">
                                      <?php if ($connection->active): ?>
                                        <?= $this->Form->postLink(__('<i class="fas fa-ban"></i>'), ['action' => 'active', $connection->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info', 'confirm' => __('Esta seguro de desactivar al jugador: {0}?', $connection->player->firstname . ' ' . $connection->player->lastname)]) ?>
                                      <?php else: ?>
                                        <?= $this->Form->postLink(__('<i class="fas fa-check"></i>'), ['action' => 'active', $connection->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info', 'confirm' => __('Esta seguro de activar al jugador: {0}?', $connection->player->firstname . ' ' . $connection->player->lastname)]) ?>
                                      <?php endif; ?>
                                      <?= $this->Html->link(__('<i class="fas fa-history"></i>'), ['controller' => 'Records', 'action' => 'historyPlayer', $connection->player_id], ['escape'=>false, 'class' =>'btn btn-xs btn-info']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination m-0 float-right">
                      <?= $this->Paginator->first('&lsaquo;', ['escape' => false]) ?>
                      <?= $this->Paginator->prev('&laquo;', ['escape' => false]) ?>
                      <?= $this->Paginator->numbers() ?>
                      <?= $this->Paginator->next('&raquo;', ['escape' => false]) ?>
                      <?= $this->Paginator->last('&rsaquo;', ['escape' => false]) ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Pág {{page}} / {{pages}}, mostrando {{current}} registro(s) de un total de {{count}}')]) ?></p>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
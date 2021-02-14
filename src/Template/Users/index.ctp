<!-- Content Header (Page header) -->
<section class="content-header apal-page" data-sidebar="creators">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Creadores</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Creadores</li>
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
                        Lista de Creadores
                        &nbsp&nbsp
                        <?= $this->Html->link(__('<i class="fas fa-plus"></i>'), ['action' => 'add'], ['escape'=>false, 'class' =>'btn btn-sm btn-info']) ?>
                    </h3>

                    <div class="card-tools">
                      <?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Users', 'action' => 'index'], 'role' => 'form']) ?>
                        <div class="input-group input-group-sm search-tool">
                          <input type="text" name="search" value="<?= $search ?>" class="form-control float-right" placeholder="Buscar... usuario, nombre, email o código">

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
                                <th scope="col"><?= $this->Paginator->sort('username', 'Usuario') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('code', 'Código') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email', 'Email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('phone', 'Teléfono') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('active', 'Estado') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created', 'Creado') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified', 'Actualizado') ?></th>
                                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody class="tbody-xs">
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= h($user->username) ?></td>
                                    <td><?= h($user->name) ?></td>
                                    <td><?= h($user->code) ?></td>
                                    <td><?= h($user->email) ?></td>
                                    <td><?= h($user->phone) ?></td>
                                    <td><?= $status[$user->active] ?></td>
                                    <td><?= h($user->created->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td><?= h($user->modified->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td class="actions">
                                      <?php if ($user->active): ?>
                                        <?= $this->Form->postLink(__('<i class="fas fa-ban"></i>'), ['action' => 'active', $user->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info', 'confirm' => __('Esta seguro de desactivar al usuario: {0}?', $user->username)]) ?>
                                      <?php else: ?>
                                        <?= $this->Form->postLink(__('<i class="fas fa-check"></i>'), ['action' => 'active', $user->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info', 'confirm' => __('Esta seguro de activar al usuario: {0}?', $user->username)]) ?>
                                      <?php endif; ?>
                                      <?= $this->Html->link(__('<i class="fas fa-key"></i>'), ['action' => 'updatePassword', $user->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info']) ?>
                                      <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['action' => 'edit', $user->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info']) ?>
                                      <?= $this->Form->postLink(__('<i class="fas fa-trash"></i>'), ['action' => 'delete', $user->id], ['escape'=>false, 'class' =>'btn btn-xs btn-warning', 'confirm' => __('Esta seguro de eliminar al usuario: {0}?', $user->username)]) ?>
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
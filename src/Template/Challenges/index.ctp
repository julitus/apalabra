<!-- Content Header (Page header) -->
<section class="content-header apal-page" data-sidebar="challenges">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Desafíos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Desafíos</li>
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
                        Lista de Desafíos
                        &nbsp&nbsp
                        <?= $this->Html->link(__('<i class="fas fa-plus"></i>'), ['action' => 'add'], ['escape'=>false, 'class' =>'btn btn-sm btn-info']) ?>
                    </h3>

                    <div class="card-tools">
                      <?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Challenges', 'action' => 'index'], 'role' => 'form']) ?>
                        <div class="input-group input-group-sm search-tool">
                          <input type="text" name="search" value="<?= $search ?>" class="form-control float-right" placeholder="Buscar... nombre">

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
                                <th scope="col"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('code', 'Clave') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('time', 'Tiempo') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('points', 'Puntos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('rows', 'N° Preguntas') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('attemps', 'N° Intentos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('active', 'Estado') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified', 'Actualizado') ?></th>
                                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody class="tbody-xs">
                            <?php foreach ($challenges as $challenge): ?>
                                <tr>
                                    <td><?= h($challenge->name) ?></td>
                                    <td><?= h($challenge->code) ?></td>
                                    <td><?= $this->Number->format($challenge->time) ?></td>
                                    <td><?= $this->Number->format($challenge->points) ?></td>
                                    <td><?= $this->Number->format($challenge->rows) ?></td>
                                    <td><?= $this->Number->format($challenge->attemps) ?></td>
                                    <td><?= $status[$challenge->active] ?></td>
                                    <td><?= h($challenge->modified->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td class="actions">
                                      <?php if ($challenge->active): ?>
                                        <?= $this->Form->postLink(__('<i class="fas fa-ban"></i>'), ['action' => 'active', $challenge->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info', 'confirm' => __('Esta seguro de desactivar el desafío: {0}?', $challenge->name)]) ?>
                                      <?php else: ?>
                                        <?= $this->Form->postLink(__('<i class="fas fa-check"></i>'), ['action' => 'active', $challenge->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info', 'confirm' => __('Esta seguro de activar el desafío: {0}?', $challenge->name)]) ?>
                                      <?php endif; ?>
                                      <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['action' => 'edit', $challenge->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info']) ?>
                                      <?= $this->Form->postLink(__('<i class="fas fa-trash"></i>'), ['action' => 'delete', $challenge->id], ['escape'=>false, 'class' =>'btn btn-xs btn-warning', 'confirm' => __('Esta seguro de eliminar el desafío: {0}?', $challenge->name)]) ?>
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
<!-- Content Header (Page header) -->
<section class="content-header apal-page" data-sidebar="challenges">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Resultados</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><?= $this->Html->link(__('Desafíos'), ['controller' => 'Challenges', 'action' => 'index'], ['escape'=>false]) ?></li>
          <li class="breadcrumb-item active">Resultados</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Resultados del Desafío: <?= $challenge->name ?>
                    </h3>

                    <div class="card-tools">
                      <?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Results', 'action' => 'index', $challenge->id], 'role' => 'form']) ?>
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
                                <th scope="col"><?= $this->Paginator->sort('Players.firstname', 'Jugador') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('best_score', 'Mejor Puntaje') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('attemps', 'N° Intentos') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Results.modified', 'Último Intento') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Results.created', 'Primer Intento') ?></th>
                                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody class="tbody-xs">
                            <?php foreach ($results as $result): ?>
                                <tr>
                                    <td><?= h($result->player->firstname.' '.$result->player->lastname.' ('.$result->player->email.')') ?></td>
                                    <td><?= $this->Number->format($result->best_score) ?></td>
                                    <td><?= $this->Number->format($result->attemps) ?></td>
                                    <td><?= h($result->modified->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td><?= h($result->created->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
                                    <td class="actions">
                                      <?= $this->Html->link(__('<i class="fas fa-history"></i>'), ['controller' => 'Records', 'action' => 'historyResult', $result->id], ['escape'=>false, 'class' =>'btn btn-xs btn-info']) ?>
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
                    <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Regresar'), ['controller' => 'Challenges' , 'action' => 'index'], ['class' => 'btn btn-secondary mt-2', 'escape' => false]) ?>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
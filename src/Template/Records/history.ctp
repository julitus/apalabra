<!-- Content Header (Page header) -->
<section class="content-header apal-page" data-sidebar="records">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Historial de Juego</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Historial de Juego</li>
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
                        Historial de Juego
                    </h3>

                    <div class="card-tools">
                      <?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Records', 'action' => 'history'], 'role' => 'form']) ?>
                        <div class="input-group input-group-sm search-tool">
                          <input type="text" name="search" value="<?= $search ?>" class="form-control float-right" placeholder="Buscar... nombre, apellido, email o desafío">

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
                                <th scope="col"><?= $this->Paginator->sort('Challenges.name', 'Desafío') ?></th>
                                <th scope="col">Puntaje</th>
                                <th scope="col">Tiempo</th>
                                <th scope="col">Acertados</th>
                                <th scope="col">Errados</th>
                                <th scope="col"><?= $this->Paginator->sort('Records.created', 'Jugado') ?></th>
                            </tr>
                        </thead>
                        <tbody class="tbody-xs">
                            <?php foreach ($records as $record): ?>
                                <tr>
                                    <td><?= h($record->player->firstname.' '.$record->player->lastname.' ('.$record->player->email.')') ?></td>
                                    <td><?= h($record->challenge->name) ?></td>
                                    <td><?= $this->Number->format($record->score) ?></td>
                                    <td><?= $this->Number->format($record->time) ?></td>
                                    <td><?= $this->Number->format($record->successful) ?></td>
                                    <td><?= $this->Number->format($record->wrong) ?></td>
                                    <td><?= h($record->created->i18nFormat('dd-MM-yyyy HH:mm')) ?></td>
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
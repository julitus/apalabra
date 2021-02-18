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
          <li class="breadcrumb-item"><?= $this->Html->link(__('Desafíos'), ['action' => 'index'], ['escape'=>false]) ?></li>
          <li class="breadcrumb-item active">Editar</li>
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
                <h3 class="card-title">Editar Desafío</h3>
              </div>

              <?= $this->Form->create($challenge) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Nombre', 'maxlength' => 32, 'placeholder' => 'max. 32 caracteres.']) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $this->Form->control('code', ['class' => 'form-control', 'label' => 'Clave']) ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?= $this->Form->control('time', ['class' => 'form-control', 'label' => 'Tiempo', 'step' => 1, 'placeholder' => 'en segundos.']) ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?= $this->Form->control('points', ['class' => 'form-control', 'label' => 'Puntos', 'readonly']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input text"><label>Preguntas</label></div>
                        </div>
                    </div>
                    <div class="row" id="questions" data-row="<?= count($challenge->questions)?>">
                        <?php foreach ($challenge->questions as $key => $question): ?>
                            <div class="col-md-12 question-row">
                                <span class="question-remove far fa-times-circle"></span>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?= $this->Form->control('questions.'.$key.'.label', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Etiqueta (max 2)', 'maxlength' => 2]) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <?= $this->Form->control('questions.'.$key.'.title', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Título']) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?= $this->Form->control('questions.'.$key.'.answer', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Respuesta']) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?= $this->Form->control('questions.'.$key.'.points', ['class' => 'form-control questions-points', 'label' => false, 'placeholder' => 'Puntos']) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?= $this->Form->control('questions.'.$key.'.clue', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Pista', 'type' => 'text']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $this->Form->button(__('<i class="fas fa-plus"></i>'), ['id' => 'add-question', 'type' => 'button', 'class' => 'btn btn-info float-right']) ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                  <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-info float-right']) ?>
                  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                </div>
              <?= $this->Form->end() ?>

            </div>

        </div>
    </div>
  </div>
</section>
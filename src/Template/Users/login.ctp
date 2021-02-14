<div class="login-box">
  <div class="login-logo">
    <?= $this->Html->image('logo.png'); ?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <?= $this->Form->create() ?>
        <?= $this->Flash->render() ?>
        <!--p class="login-box-msg"></p-->

        <div class="input-group mb-3">
          <?= $this->Form->control('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Usuario']) ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?= $this->Form->control('password', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Contraseña']) ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

      <div class="social-auth-links text-center mb-3">
        <?= $this->Form->button(__('<i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión'), ['class' => 'btn btn-block btn-primary']) ?>
      </div>
      <?= $this->Form->end() ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
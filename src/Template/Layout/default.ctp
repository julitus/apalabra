<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Aprende Palabra
        </title>
        <?= $this->Html->meta('icon') ?>

        <!--?= $this->Html->css('base.css') ?-->
        <!--?= $this->Html->css('style.css') ?-->

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <!-- Font Awesome -->
        <?= $this->Html->css('all.min.css') ?>
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- SweetAlert2 -->
        <?= $this->Html->css('bootstrap-4.min.css') ?>
        <!-- icheck bootstrap -->
        <?= $this->Html->css('icheck-bootstrap.min.css') ?>
        <!-- Theme style -->
        <?= $this->Html->css('adminlte.min.css') ?>
        <!-- Daterange picker -->
        <?= $this->Html->css('daterangepicker.css') ?>
        <!-- overlayScrollbars -->
        <?= $this->Html->css('OverlayScrollbars.min.css') ?>
        <?= $this->Html->css('last.css') ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed text-sm">
        
        <div class="wrapper">
            <?= $this->element('header'); ?>
            <?php if ($this->request->session()->read('Auth.User.role') == 0): ?>
                <?= $this->element('sidebar_admin'); ?>
            <?php else: ?>
                <?= $this->element('sidebar_creator'); ?>
            <?php endif; ?>
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="hidden">
                    <?= $this->Flash->render() ?>
                </div>
                <?= $this->fetch('content') ?>
            </div>

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Editado por <a href="#">NeOo</a>.</strong>
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 0.0.1
                </div>
            </footer>
            
        </div>
        
        <!-- jQuery -->
        <?= $this->Html->script('jquery.min.js') ?>
        <!-- jQuery UI 1.11.4 -->
        <?= $this->Html->script('jquery-ui.min.js') ?>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <?= $this->Html->script('bootstrap.bundle.min.js') ?>
        <!-- SweetAlert2 -->
        <?= $this->Html->script('sweetalert2.min.js') ?>
        <!-- daterangepicker -->
        <?= $this->Html->script('moment.min.js') ?>
        <?= $this->Html->script('daterangepicker.js') ?>
        <!-- overlayScrollbars -->
        <?= $this->Html->script('jquery.overlayScrollbars.min.js') ?>
        <!-- AdminLTE App -->
        <?= $this->Html->script('adminlte.min.js') ?>
        <?= $this->Html->script('last.js') ?>
    </body>

    <div class="modal fade" id="modal-change-pass">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cambiar mi contraseña</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?= $this->Form->create(null, ['type' => 'post', 'url' => ['controller' => 'Users', 'action' => 'changePassword'], 'role' => 'form']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <?= $this->Form->control('new_password', ['class' => 'form-control', 'label' => 'Nueva Contraseña', 'minlength' => 6, 'type' => 'password', 'placeholder' => 'mín. 6 caracteres.', 'value' => '', 'required']) ?>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <?= $this->Form->button(__('Cerrar'), ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) ?>
                    <?= $this->Form->button(__('Actualizar'), ['class' => 'btn btn-info']) ?>
                </div>
            <?= $this->Form->end() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->  

    <script type="text/javascript">
        $( document ).ready(function() {

            var e;

            if ($('.apal-page').length > 0) {
                e = $('.apal-page').data("sidebar").split("-");
                if ($('#apal-' + e[0]).length > 0) {
                    $('#apal-' + e[0]).addClass("active");
                    if(e.length > 1) {
                        $('#apal-' + e[0]).parent().addClass("menu-open");
                        $('#apal-' + e[0]).parent().find('ul li:nth-child('+e[1]+') a').addClass("active");
                    }
                }
            }

        });

        var alertElem = $('.message-alert');
        if (alertElem.length > 0) {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 20000
            });

            if (alertElem.hasClass("error")) {
                Toast.fire({
                    type: 'error',
                    title: alertElem.html()
                  });
            } else if (alertElem.hasClass("success")) {
                Toast.fire({
                    type: 'success',
                    title: alertElem.html()
                  });
            }
        }

    </script>
</html>

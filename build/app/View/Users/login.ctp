<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="ThemeBucket">
      <link rel="shortcut icon" href="/app/webroot/images/favicon.ico" type="image/x-icon">

      <title><?php echo getenv('PAGE_TITLE'); ?></title>

      <!--Core CSS -->
      <link href="/app/webroot/css/bs3/css/bootstrap.min.css" rel="stylesheet">
      <link href="/app/webroot/css/bootstrap-reset.css" rel="stylesheet">
      <link href="/app/webroot/css/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

      <!-- Custom styles for this template -->
      <link href="/app/webroot/css/style.css" rel="stylesheet"/>
      <link href="/app/webroot/css/style-responsive.css" rel="stylesheet" />

    </head>

  <body class="login-body">
      <?php
        $flash = $this->Session->flash();
        if (!empty($flash)) {
          echo '<div class="alert alert-info col-md-4 pull-right">'.$flash.'</div>';
        }
      ?>
      <?php echo $this->Form->create('User', array('class' => 'form-signin', 'role' => 'form')); ?>
        <h2 class="form-signin-heading">SGI - <?php echo getenv('SGI_BRAND'); ?></h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <?php 
                  echo $this->Form->input('username', array('placeholder' => 'E-mail', 'autofocus', 'label' => false, 'class' => 'form-control'));
                  echo $this->Form->input('password', array('placeholder' => 'Senha', 'autofocus', 'label' => false, 'class' => 'form-control'));
                ?>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Lembre-me
                <span class="pull-right">
                    <a data-toggle="modal" color="665F5F" href="#myModal"> Esqueci minha senha</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Entrar</button>
            
        </div>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Esqueceu sua senha?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Entre com seu email para receber uma mensagem para redefinir a senha.</p>
                          <input type="text" name="email" placeholder="E-mail" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                          <button class="btn btn-success" type="button">Me envie a mensagem</button>
                          </html>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      <?php echo $this->Form->end(); ?>

    <script src="/app/webroot/js/lib/jquery.js"></script>
    <script src="/app/webroot/css/bs3/js/bootstrap.min.js"></script>

</body>
</html>

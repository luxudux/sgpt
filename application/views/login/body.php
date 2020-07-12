<body>
      <?php //echo validation_errors(); ?>
        <div class="container">
        <?php echo form_open('Login/entrar'); ?>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- <h2>Sistema de Gestión de Producción de Tortilla</h2> -->
                    <img src="<?php echo base_url('images/logo.jpg'); ?>" alt="Smiley face" class="img-fluid" />
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="email">Correo</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                            <input type="email" name="email" class="form-control" id="email"
                                  value="<?php echo set_value('email'); ?>" placeholder="tu@correo.com" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- <i class="fa fa-times"></i>  -->
                            <?php echo form_error('email');?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Contraseña</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                            <input type="password" name="password" class="form-control" id="password"
                                  value="<?php echo set_value('password'); ?>" placeholder="Contraseña" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                        <!-- Put password error message here -->
                           <?php echo form_error('password');?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="padding-top: .35rem">
                    <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                        <label class="form-check-label">
                            <input class="form-check-input" name="remember"
                                   type="checkbox" >
                            <span style="padding-bottom: .15rem">Remember me</span>
                        </label>
                    </div>
                </div>
            </div> -->
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-link" href="#">Olvidaste tu contraseña?</a>
                    <button type="submit" class="btn btn-info"><i class="fa fa-sign-out-alt"></i> Entrar al sistema </button>

                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</body>
</html>

<section id="login_view">

    <?php echo $this->Session->flash('auth'); ?>

    <h2>Login</h2>

    <?php echo $this->Form->create(
        'User',
        array(
            'type' => 'post',
            'action' => 'login',
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => "form-horizontal",
            'role' => "form"
        )
    ); ?>

    <!-- Username -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'username',
                array(
                    'type' => 'text',
                    'placeholder' => 'Username',
                    'class' => 'form-control'
                )
            ); ?>
        </div>
    </div>

    <!-- Password -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'password',
                array(
                    'type' => 'password',
                    'placeholder' => 'Password',
                    'class' => 'form-control'
                )
            ); ?>
        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <div class="form-input"><?php echo $this->Html->link('Forgotten password?', '/users/sendResetEmail'); ?></div>
        <div class="submit-button">
            <?php echo $this->Form->button(
                'Login',
                array(
                    'type' => 'submit',
                    'class' => 'btn btn-default'
                )
            ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-offset-4 col-xs-offset-1 col-xs-10 col-sm-4 divider"></div>
    </div>

    <div class="row">
        <h4 class="col-xs-12 text-center">Sign in using social media</h4>
    </div>
    <div class="row">
        <div class="text-center col-lg-offset-4 col-lg-2"><?php echo $this->Html->link($this->Html->image('facebookLogin.gif', array('alt' => 'Login with Facebook')), '/auth/facebook', array('escape' => false)); ?></div>
        <div id="googleSignIn" class="text-center col-lg-2"><?php echo $this->Html->link($this->Html->image('googleLogin.gif', array('alt' => 'Login with Google')), '/auth/google', array('escape' => false)); ?></div>
    </div>
<!--    <div class="row">-->
<!--        <div id="googleSignIn" class="text-center">--><?php //echo $this->Html->link($this->Html->image('googleLogin.gif', array('alt' => 'Login with Google')), '/auth/google', array('escape' => false)); ?><!--</div>-->
<!--    </div>-->

    <?php echo $this->Form->end(); ?>

</section>

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
        <div class="form-input"><?php echo $this->Html->link('Forgotten password?','/users/sendResetEmail'); ?></div>
        <div class="form-input"><?php echo $this->Html->link('Sign in with Facebook?','/auth/facebook'); ?></div>
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

    <?php echo $this->Form->end(); ?>

</section>

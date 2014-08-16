<section id="login_view">

    <div class="col-sm-6">
        <h4 class="alignCenter">A simple and elegant web app for creating reminders that will be delivered straight
            to
            your inbox.</h4>
    </div>

    <?php echo $this->Session->flash('auth'); ?>

    <div class="col-sm-4 col-sm-offset-1">

        <h2>Sign In</h2>

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
                        'class' => 'form-control',

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
            <div
                class="form-input"><?php echo $this->Html->link('Forgotten password?', '/users/sendResetEmail'); ?></div>
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
            <div class="divider"></div>
        </div>

        <?php echo $this->Form->end(); ?>

        <div class="row">
            <h4 id="signInBlurb">Sign in using social media</h4>
        </div>

        <div id="socialSignIn">
        <div id="facebookLogin"
             class="img-responsive"><?php echo $this->Html->link($this->Html->image('facebookfinal.png', array('alt' => 'Sign in with Facebook')), '/auth/facebook', array('escape' => false)); ?></div>
<!--        <div id="googleLogin"-->
<!--             class="img-responsive">--><?php //echo $this->Html->link($this->Html->image('googlefinal.png', array('alt' => 'Sign in with Google')), '/auth/google', array('escape' => false)); ?><!--</div>-->
<!--        </div>-->

    </div>

</section>

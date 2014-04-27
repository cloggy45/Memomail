<section id="reset_password_view">

    <h2>Reset Password</h2>

    <?php echo $this->Form->create(
        'User',
        array(
            'type' => 'post',
            'action' => 'resetPassword',
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => "form-horizontal",
            'role' => "form"
        )
    ); ?>

    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'password',
                array(
                    'type' => "password",
                    'placeholder' => "New Password",
                    'class' => "form-control"
                )
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'confirm_password',
                array(
                    'type' => "password",
                    'placeholder' => "Confirm Password",
                    'class' => "form-control"
                )
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="submit-button">
            <?php echo $this->Form->button(
                "Reset Password",
                array(
                    'type' => "submit",
                    'class' => "btn btn-default"
                )
            ); ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>

</section>
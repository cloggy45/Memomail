<section id="send_reset_email">

    <h2>Send Reset Email</h2>

    <?php echo $this->Form->create(
        'User',
        array(
            'type' => "post",
            'action' => "sendResetEmail",
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
                'resetEmail',
                array(
                    'type' => "email",
                    'placeholder' => "Email Address",
                    'class' => "form-control"
                )
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="submit-button" id="apply-btn">
            <?php echo $this->Form->button(
                "Send Reset Instructions",
                array('type' => 'submit', 'class' => 'btn btn-default')
            ); ?>
        </div>
    </div>

</section>
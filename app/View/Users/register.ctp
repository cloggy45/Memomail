<section id="register_view">

    <h2>Register</h2>

    <?php echo $this->Form->create(
        'User',
        array(
            'type' => 'post',
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'form-horizontal',
            'role' => 'form'
        )
    ); ?>

    <!-- Username -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'username',
                array(
                    'type' => 'text',
                    'class' => "form-control",
                    'placeholder' => "Username",
                    'error' => false,
                    'data-validation' => 'length alphanumeric',
                    'data-validation-length' => '8-20'
                    //'data-validation-help' => "Username must be alphanumerical and between 8-20 characters"
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
                    'class' => 'form-control',
                    'placeholder' => 'Password',
                    'data-validation' => 'length strength',
                    'data-validation-length' => '8-20',
                    'data-validation-strength' => '2',
                    'data-validation-optional' => 'true'
                )
            ); ?>
        </div>
    </div>

    <!-- Re-enter Password -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'confirm_password',
                array(
                    'type' => 'password',
                    'class' => 'form-control',
                    'placeholder' => 'Re-enter Password',
                    'data-validation' => 'original_password'
                )
            ); ?>
        </div>
    </div>

    <!-- Email -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'email',
                array(
                    'type' => 'email',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'error' => false,
                    'data-validation' => 'email'
                )
            ); ?>
        </div>
    </div>

    <!-- Re-enter Email -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'confirm_email',
                array(
                    'type' => 'email',
                    'class' => 'form-control',
                    'placeholder' => 'Re-enter Email',
                    'data-validation' => "email original_email",
                    'error' => false,
                    'data-validation' => 'email'
                )
            ); ?>
        </div>
    </div>

    <!-- Enter Timezone -->
    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Timezone->select('timezone', NULL, array('class' => 'form-control')); ?>
        </div>
    </div>


    <div class="form-group">
        <div class="submit-button">
            <?php echo $this->Form->button(
                'Submit',
                array(
                    'type' => 'submit',
                    'class' => 'btn btn-default'
                )
            ); ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>

</section>
<section id="submit_form">
    <h2>Support</h2>

    <?php echo $this->Form->create(
        'Support',
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

    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'subject',
                array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Subject',
                    'data-validation' => 'length',
                    'data-validation-length' => '5-30',
                    'data-validation-optional' => 'false'
                )
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'category',
                array('options' => array('Bug', 'Feature Request', 'General'),
                'class' => 'form-control')
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="form-input">
            <?php echo $this->Form->input(
                'body',
                array(
                    'type' => 'textarea',
                    'rows' => '5',
                    'class' => 'form-control',
                    'data-validation' => 'length',
                    'data-validation-length' => '10-290',
                    'data-validation-optional' => 'false'
                )
            ); ?>
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
<h2>Hey <?php echo $username ?><h2>

        Thank you for registering. Please <?php echo $this->Html->link(
            'Click Here',
            'http://192.168.0.5/cake/Users/activateAccount/hash:' . $hash
        ); ?> to finish your registration.

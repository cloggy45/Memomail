<h2>Hey <?php echo $username ?><h2>

        In order to reset your password. Please <?php echo $this->Html->link(
            'Click Here',
            'http://192.168.0.6/cake/Users/resetPassword/hash:' . $hash
        ); ?> to finish your registration.

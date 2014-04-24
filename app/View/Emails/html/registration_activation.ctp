<tr>
    <td>
        <table class="twelve columns">
            <h2>Hey <?php echo $username ?></h2>
            <p>Thank you for registering. Please <?php echo $this->Html->link(
                    'Click Here',
                    'http://192.168.0.11/cake/Users/activateAccount/hash:' . $hash
                ); ?> to finish your registration.</p>
        </table>
    </td>
</tr>
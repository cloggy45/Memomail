<table class="row">
    <tr>
        <td class="wrapper last">
            <table class="twelve columns">
                <tr>
                    <td>
                        <h1>Hi, <?php echo $username; ?> </h1>

                        <p class="lead">In order to reset your password. Please <?php echo $this->Html->link(
                                'Click Here',
                                $address . $hash
                            ); ?> to reset your password.</p>
                    </td>
                    <td class="expander"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!--                <table class="row callout">-->
<!--                    <tr>-->
<!--                        <td class="wrapper last">-->
<!---->
<!--                            <table class="twelve columns">-->
<!--                                <tr>-->
<!--                                    <td class="panel">-->
<!--                                        <p>Phasellus dictum sapien a neque luctus cursus. Pellentesque sem dolor,-->
<!--                                            fringilla et pharetra vitae. <a href="#">Click it! »</a></p>-->
<!--                                    </td>-->
<!--                                    <td class="expander"></td>-->
<!--                                </tr>-->
<!--                            </table>-->
<!---->
<!--                        </td>-->
<!--                    </tr>-->
<!--                </table>-->
<div class="row">
    <div id="sub-container">
        
        <td><?php echo $title ?> </td>


        <?php if (strlen($body) > 40): ?>

            <?php $stringDisplay = substr($body, 0, 20); ?>

            <td><?php echo $stringDisplay . ".
                                    .."; ?> 
            
            <?php echo "<a data-toggle='modal' data-id=" . $id . " data-target='#myModal" . $id . "'>More</a>";
            ?>
            </td>

        <?php else: ?>

            <td><?php echo $body; ?> </td>

        <?php endif; ?>

        <td><?php echo $time ?></td>
        <td><?php echo $temDate = CakeTime::format($date, '%d-%m-%y'); ?></td>


        <td>
            <?php
            echo $this->Html->link('Delete', '/Reminder/delete?id=' . $id);
            ?>
        </td>
    </div>
</div>
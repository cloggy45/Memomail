<div class="row">
    <div id="sub-container">
        
        <h2><?php echo $title ?> </h2>


        <?php if (strlen($body) > 40): ?>

            <?php $stringDisplay = substr($body, 0, 20); ?>

            <p><?php echo $stringDisplay . ".
                                    .."; ?> </p>

            <?php echo "<button id='btn' class='btn btn-primary btn-sm' data-toggle='modal' data-id=" . $id . " data-target='#myModal" . $id . "'>More</button>";
            ?>
            </p>

        <?php else: ?>

            <p><?php echo $body; ?> </p>

        <?php endif; ?>



        <p id="time">Time: <?php echo $time ?></p>

        <p id="date">Date: <?php echo $temDate = CakeTime::format($date, '%d-%m-%y'); ?></p>


        <div>
            <?php
            echo $this->Html->link('Delete', '/Reminder/delete?id=' . $id, array('class' => 'btn btn-primary btn-sm'));
            ?>
        </div>
    </div>
</div>
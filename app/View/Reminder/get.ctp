<?php App::uses('CakeTime', 'Utility'); ?>

<div id="get_view" class="table-responsive">

    <table class="table">
        <thead>
        <tr>
            <th>Event</th>
            <th>Description</th>
            <th>Time</th>
            <th>Date</th>
            <th></th>
        </tr>
        </thead>


        <?php foreach ($reminders as $reminder): ?>
            <tr>
                <?php echo $this->element(
                    'getViewDataContainer',
                    array(
                        'id' => $reminder['Reminder']['id'],
                        'title' => $reminder['Reminder']['title'],
                        'body' => $reminder['Reminder']['body'],
                        'time' => $reminder['Reminder']['time'],
                        'date' => $reminder['Reminder']['date'],
                    )
                ); ?>
            </tr>

            <?php echo $this->element(
                'modalDialog',
                array(
                    'id' => $reminder['Reminder']['id'],
                    'modalBodyContent' => $reminder['Reminder']['body']
                )
            ); ?>

        <?php endforeach; ?>

        <?php unset($post); ?>
    </table>
</div>


<script>
    var myMessage = <?php echo json_encode($message); ?>;
    alertify.error(myMessage);
</script>


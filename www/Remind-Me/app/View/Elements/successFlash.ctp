<script>
    var myMessage = <?php echo json_encode($message); ?>;
    alertify.success(myMessage);
</script>


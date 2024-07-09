<?php
function alert_and_redirect($message,$path){
    echo '<script>
            alert('.$message.');
            window.location.replace('.$path.');
        </script>';
}
?>
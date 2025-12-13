<?php
setcookie('visit_count', '', time() - 3600);
header("Location: visits.php");
?>
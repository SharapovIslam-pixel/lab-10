<?php
setcookie(
    "user", 
    "Islam", 
    time() + 3600, 
    "/", 
    "", 
    true,  // secure — только по HTTPS
    true   // httponly — недоступна для JavaScript
);
echo "Защищённая cookie установлена.";
?>
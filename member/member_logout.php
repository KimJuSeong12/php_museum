<?php
session_start();
unset($_SESSION["num"]);
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["userlevel"]);
unset($_SESSION["userpoint"]);

print("
       <script>
       self.location.href = 'http://{$_SERVER['HTTP_HOST']}/php_source/project/index.php';
         </script>
       ");

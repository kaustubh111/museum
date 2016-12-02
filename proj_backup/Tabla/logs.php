<?php
session_start();
echo $_SESSION['st2'];
 $t=time();
$_SESSION['tim']=$t-$_SESSION['st1'];


echo $_SESSION['pak'];
session_write_close();
?>
<!DOCTYPE html>
<html>
<body>
 
</body>
</html>
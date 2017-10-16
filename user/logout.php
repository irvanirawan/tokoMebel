<?php
session_start();
session_destroy();
 
echo '<script language="javascript">alert("Logout Sukses, Terima Kasih"); document.location="../index.php";</script>';
?>
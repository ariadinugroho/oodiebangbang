
<?php 
session_start();
session_destroy();

echo "<script>alert('You Have Logged Out');</script>";
echo "<script>location='index.php';</script>";
?>
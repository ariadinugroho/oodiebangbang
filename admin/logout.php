<?php
session_destroy();
echo "<script>alert('You Have Logged Out');</script>";
echo "<script>location='login.php'</script>";
?>
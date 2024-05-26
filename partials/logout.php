<?php 
session_start();
echo 'you are logging out... Please wait';
session_destroy();
header('location: /forum ');
?>
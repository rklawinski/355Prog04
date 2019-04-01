<?php
session_start();
session_destroy(); // Destroy session and send user back to login.php
header("Location: login.php");
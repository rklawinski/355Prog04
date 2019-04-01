<?php
require "customers.class.php";

// Create customer and use create_record() from customers.class.php to handle new user creation
$cust = new Customer();
$cust->create_record();
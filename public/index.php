<?php

use app\src\Mail;

require "../vendor/autoload.php";

$email = new Mail;
$email->send();
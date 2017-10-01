<?php

header('Content-Type: text/plain');
$name = isset($_GET ['name']) ? $_GET['name'] : 'Noname';
echo 'Hello, Dear '. $name . '!';
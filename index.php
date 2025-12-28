<?php
http_response_code(301);
$path = $_SERVER['REQUEST_URI'];
header("Location: $path/woofminer");
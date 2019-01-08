<?php

$params = $_SERVER['REQUEST_URI'];

echo ltrim($params,'/'); 

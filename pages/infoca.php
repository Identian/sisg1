<?php

$arrayca = array();
$arrayca = getallheaders();


$alias=$arrayca['SM_USER'];
echo $alias;
print_r $arrayca;
?>
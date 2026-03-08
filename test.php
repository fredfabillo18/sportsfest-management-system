<?php
$my_array = array('sheldon', 'leonard', 'howard', 'penny');
print_r($my_array);
$to_remove = array('howard');
$result = array_diff($my_array, $to_remove);
echo "\n";
print_r($result);
?>
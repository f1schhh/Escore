<?php
$hej = 5 / 7;
$real = round($hej, 2);
$procent = array_map('intval', explode('.', $real));
echo $procent[1];
echo "% Winrate";
?>
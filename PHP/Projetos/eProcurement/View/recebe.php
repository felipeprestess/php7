<?php
var_dump($_POST['selected']);
foreach ($_POST['selected'] as $selectedOption)
    echo $selectedOption."\n <br>";
<?php
    ini_set("display_errors","on");
    include("class.bonanza.php");
    $myBonanza = new BonanzaAPI();
    $response = $myBonanza->submitTracking("39000060","ontrac","D10010919794580");
    print_r($response);

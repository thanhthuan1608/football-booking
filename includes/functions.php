<?php

function formatMoney($money)
{
    return number_format($money,0,",",".") . " VNĐ";
}

function redirect($url)
{
    header("Location: $url");
    exit();
}

?>
<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "football_booking"
);

if(!$conn){
    die("Lỗi kết nối database");
}
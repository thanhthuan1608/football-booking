<?php

require_once("../config/database.php");

$id = $_GET['id'];

mysqli_query(
$conn,
"DELETE FROM football_fields WHERE id=$id"
);

header("Location: manage_fields.php");
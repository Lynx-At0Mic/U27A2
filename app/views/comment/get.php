<?php

$return_array = array(
    "success" => $success,
    "error" => $error,
    "comments" => $comments);

echo json_encode($return_array);
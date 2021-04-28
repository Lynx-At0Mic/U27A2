<?php

$return_array = array(
    "valid" => $validLogin,
    "error" => $error);

echo json_encode($return_array);
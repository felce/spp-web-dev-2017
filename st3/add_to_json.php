<?php

    $data = 'data.json';
    $jsonData = json_decode(file_get_contents($data), true);
    $index = count($jsonData);
    $jsonData[$index]['index'] = "";

    $newJsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
    file_put_contents($data, $newJsonString);

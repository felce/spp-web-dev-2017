<?php

    $data = 'data.json';
    $jsonData = json_decode(file_get_contents($data), true);
    $index = $_POST['index'];
    $jsonData[$index]['index'] = '';
    $jsonData[$index]['text'] = '';
    $jsonData[$index]['coords'][0] = 0;
    $jsonData[$index]['coords'][1] = 0;
    $newJsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
    file_put_contents($data, $newJsonString);

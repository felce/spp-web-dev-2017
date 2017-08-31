<?php

    $data = 'data.json';
    $jsonData = json_decode(file_get_contents($data), true);
    $index = count($jsonData);
    $jsonData[$_POST['index']]['index'] = $_POST['index'];
    $jsonData[$_POST['index']]['text'] = $_POST['text'];
    $jsonData[$_POST['index']]['coords'][0] = $_POST['left'];
    $jsonData[$_POST['index']]['coords'][1] = $_POST['top'];

    $newJsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
    file_put_contents($data, $newJsonString);

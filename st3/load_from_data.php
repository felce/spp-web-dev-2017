<?php
    $data = 'data.json';
    $jsonData = json_decode(file_get_contents($data), true);
    for ($i = 0; $i < count($jsonData); $i++) {
      if ( $jsonData[$i]['index'] !="" ){
        $id =  $jsonData[$i]['index'];
        $text = $jsonData[$i]['text'];
        if ($id != "" && $text != "" ) {
          $left =  $jsonData[$i]['coords'][0];
          $top =  $jsonData[$i]['coords'][1];
          $text = $jsonData[$i]['text'];
          echo '<div id="',$id,'" class="draggable" style="position:absolute; left: ',$left, 'px; top: ',$top,'px;">', $text, '</div>';
        }
      }
    }

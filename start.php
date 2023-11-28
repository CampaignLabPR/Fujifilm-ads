<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  function loadAnimationFiles(){
    $dir    = './json';
    $files = glob($dir . DIRECTORY_SEPARATOR . "*.json");
    $jsonFile = [];

    foreach ($files as $file) {
      $json = file_get_contents($file);
      // Decode the JSON file
      $json_data = json_decode($json, false);
      // Display data
      $json = new stdClass();
      $json->url    = str_replace('\/',"/", $file);
      $json->name   = $json_data->nm;
      $json->width  = $json_data->w;
      $json->height = $json_data->h;

      array_push($jsonFile, $json);

    }

    return $jsonFile;
  }

  print_r(json_encode(loadAnimationFiles(), JSON_UNESCAPED_SLASHES));
?>

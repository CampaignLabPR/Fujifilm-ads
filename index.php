<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/styles.css">
     <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <title></title>
  </head>
  <body>

    <div class="header">
        <h1>Fujifilm HOP ads v1</h1>
    </div>
    <div id="id-list"></div>

  </body>

  <?php
    function loadAnimationFiles(){
      $dir    = './json';
      $files = glob($dir . DIRECTORY_SEPARATOR . "*.json");
      $jsonFile = [];
      $sizes = [];
      $result = [];

      foreach ($files as $file) {
        $json = file_get_contents($file);
        // Decode the JSON file
        $json_data = json_decode($json, false);
        // Display data
        $json = new stdClass();
        $json->url      = $file;
        $json->name     = $json_data->nm;
        $json->width    = $json_data->w;
        $json->height   = $json_data->h;
        $json->section  = $json_data->w."x".$json_data->h;

        if (!in_array($json->section, $sizes)) {
            array_push($sizes, $json->section);
        }
        array_push($jsonFile, $json);
      }
      return $jsonFile;
    }

    $RESULT = loadAnimationFiles();
    $animListFile = fopen("animList.js", "w") or die("Unable to open file!");
    $content = "const lottieFiles=".json_encode($RESULT, JSON_UNESCAPED_SLASHES);
    fwrite($animListFile, $content);
    fclose($animListFile);

    echo "<h3>File created</h3>\n";
    echo "<script>".$content."</script>\n";
    echo "<script src='view.js'></script>";
  ?>
</html>

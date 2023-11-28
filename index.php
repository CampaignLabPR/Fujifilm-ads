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
      $files  = glob($dir . DIRECTORY_SEPARATOR . "*.json");
      $jsonFiles = [];

      $pattern = "/([\w|-]+)(\.[a-z]{3,4})/i";

      foreach ($files as $file) {
        $json = file_get_contents($file);
        // Decode the JSON file
        $json_data = json_decode($json, false);
        //Get name only
        preg_match($pattern, $file, $filename);
        // Display data
        $json = new stdClass();
        $json->url      = $file;
        $json->name     = $json_data->nm;
        $json->width    = $json_data->w;
        $json->height   = $json_data->h;
        $json->section  = $json_data->w."x".$json_data->h;
        //Test if Zip exist base on name file
        if(file_exists('./json/banner/'.$filename[1].'.zip')){
          $json->zip   = './json/banner/'.$filename[1].'.zip';
        }
        //Add to array
        array_push($jsonFiles, $json);
      }
      return $jsonFiles;
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

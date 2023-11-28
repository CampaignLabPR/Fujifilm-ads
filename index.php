<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/styles.css">
     <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- <script src="setup.js"></script> -->
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

    //echo "\tvar lottieFiles=", json_encode($RESULT, JSON_UNESCAPED_SLASHES), "\n";

    $animListFile = fopen("animList.js", "w") or die("Unable to open file!");
    $content = "var lottieFiles=".json_encode($RESULT, JSON_UNESCAPED_SLASHES);
    echo $animListFile;
    fwrite($animListFile, $content);
    fclose($animListFile);
    echo "File created";
  ?>

  <!-- <script src="animList.js"></script>

  <script>

  let listLottieFiles =  lottieFiles.sort(sortbyWH);
  function sortbyWH(a, b){
    if(a.section>b.section){
      return -1
    }
    else if(a.section<b.section){
      return 1;
    }
    else {
      if(a.name>b.name){
        return 1
      }
      else if(a.name<b.name){
        return -1;
      }
      else {
        return 0;
    }
  }
  }

  console.log(listLottieFiles);

  let i=0,j=0,v=0;
  let buttonHtml = "",sectionHtml="";
  let className = "animBTN";
  let currentSection = "";
  for(j=0;j<lottieFiles.length;j++){

    //Create a new section
    if(currentSection != lottieFiles[j].section){
      let width = lottieFiles[j].width;
      let height = lottieFiles[j].height;

      //CLose previous section
      if(j>0){
        sectionHtml +=`</div>`;
      }
      sectionHtml +=`
      <div class="section">
          <span>
            <label id="id-${lottieFiles[j].section}-name" for="">
              ${lottieFiles[j].section} Please select animation
            </label>
            <span id="id-${lottieFiles[j].section}-title" class="zip"></span>
          </span>
          <lottie-player id="id-${lottieFiles[j].section}-player" style="width:${width}px;height:${height}px;" loop controls autoplay></lottie-player>
      `;
    }
    currentSection = lottieFiles[j].section;
    sectionHtml +=`
      <button id='id-${lottieFiles[j].name}' size='${lottieFiles[j].section}' class='btn-${lottieFiles[j].name} ${className}'>${lottieFiles[j].name}</button>
    `;
  }


  //Close last section
  sectionHtml +=`</div>`;

  document.getElementById(`id-list`).innerHTML = sectionHtml;

  for (let element of document.getElementsByClassName(className)){
     element.addEventListener("click", function(e){
       //console.log(e);
       let txt  = element.innerText;
       let size = element.getAttribute("size");
       //console.log(element.classList.value);
       //let disabled = element.classList.value.search(/disabled/);
       //if(disabled==-1){
         document.getElementById(`id-${size}-player`).load(`"./json/${txt}.json"`);
         document.getElementById(`id-${size}-name`).innerHTML = txt;
         document.getElementById(`id-${size}-title`).innerHTML = `<a href="./json/banner/${txt}.zip">[zip file]</a>`;
       //}


     });
  }
  </script> -->
</html>

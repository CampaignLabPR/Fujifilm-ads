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
     document.getElementById(`id-${size}-player`).load(`"./json/${txt}.json"`);
     document.getElementById(`id-${size}-name`).innerHTML = txt;
     document.getElementById(`id-${size}-title`).innerHTML = `<a href="./json/banner/${txt}.zip">[zip file]</a>`;
   });
}

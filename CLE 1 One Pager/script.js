// Wie ben ik button
const wieButton = document.querySelector("#wie")
const wieSection = document.querySelector("#wiesection")

if(wieButton){
    wieButton.addEventListener("click", function(){
      wieSection.scrollIntoView({behavior: 'smooth'});
    })
}

// Probleem button
const probleemButton = document.querySelector("#probleem")
const probleemSection = document.querySelector("#probleemsection")

if(probleemButton){
    probleemButton.addEventListener("click", function(){
      probleemSection.scrollIntoView({behavior: 'smooth'});
    })
}

//Oplossing button
const oplossingButton = document.querySelector("#oplossing")
const oplossingSection = document.querySelector("#oplossingsection")

if(oplossingButton){
    oplossingButton.addEventListener("click", function(){
      oplossingSection.scrollIntoView({behavior: 'smooth'});
    })
}

//Video button
const videoButton = document.querySelector("#video")
const videoSection = document.querySelector("#videosection")

if(videoButton){
    videoButton.addEventListener("click", function(){
      videoSection.scrollIntoView({behavior: 'smooth'});
    })
}

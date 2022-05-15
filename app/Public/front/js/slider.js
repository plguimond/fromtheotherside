// contrôle l'affichage du slider
let slideDelay = 1.5;
let slideDuration = 2;

let slide = document.querySelectorAll(".slide");
let slides = document.getElementById('slides');


let i = 0

setInterval(() => {
    
    slides.innerHTML = "";
        slides.appendChild(slide[i]);
        i++;
        if (i >= slide.length){
            i = 0;
        }}, 
        
        4000);

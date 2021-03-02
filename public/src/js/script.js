/**
 * Fichier contenant les différents scripts nécessaire au bon fonctionnement de l'application
 * Langages : JS, JQuery, Ajax
 */
//console.log(window.location.pathname);

//Première Partie : Gestion du diaporama
/**
 * @var int slideIndex : Le numéro du slide actuel
 */
var slideIndex = 0;
DefilerAuto();

/**
 * Gère le défilement des slides manuellement
 * @param {int} n Slide à afficher
 */
function Defiler(n){
    let i;
    let slides = document.getElementsByClassName("wp-diapo-img-container");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

/**
 * Permet de défiler automatiquement les slides
 */
function DefilerAuto(){
    let i;
    let slides = document.getElementsByClassName("wp-diapo-img-container");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    setTimeout(DefilerAuto, 4000); 
}

/**
 * Appel de la fonction Defiler
 * @param {int} n Slide à afficher 
 */
function Avancement(n) {
    Defiler(slideIndex += n);
}


//Seconde partie : Extraction des éléments du menu
$(document).ready(() => {
    $.ajax({
        url: ".\\src\\js\\menu.json", //On suppose que l'appel est toujours fait depuis le dossier "public\"
        dataType: "json",
        async: true,
        
        success: function(data){
            let titre, path, oppath, pageName, subcat = null, pa = $("#info").html();
            for(let i=0; i<data.length; i++){
                $.each(data[i], function(key, val){
                    if(key === "title"){ 
                        titre = val;
                    }else if(key === "path"){
                        path = val;
                    }else if(key === "op-path"){
                        oppath = val;
                    }else if(key === "subcat"){
                        subcat = val;
                    }else if(key === 'pageName'){
                        pageName = val;
                    }
                });
                

                //Affichage des catégories
                if(titre === pa){
                    $("<a href='?page="+pageName+"' class='wp-menu-elt active'><img class='wp-menu-elt-icon' src='"+ oppath +"' /><p class='wp-menu-elt-txt'>"+ titre +"</p></div>").appendTo(".wp-menu-container");
                }else{
                    $("<a href='?page="+pageName+"' class='wp-menu-elt'><img class='wp-menu-elt-icon' src='"+ path +"' /><p class='wp-menu-elt-txt'>"+ titre +"</p></div>").appendTo(".wp-menu-container");
                }  
                  
                //Affichage des sous-catégories
                /*if(subcat != null){
                   $("<div class='wp-menu-subcat-container'></div>").appendTo('.wp-menu-container:nth-child(3)');
                    for(let j=0; j<subcat.length; j++){
                        //$("<div class='wp-menu-subcat'><p>"+subcat[j]+"</p></div>").appendTo();
                    }    
                } */
            }
            //$(".wp-menu-elt")
        },
        statusCode: {
            404: function(){
                alert("Il y a eu un problème avec la récupération du menu");
            }
        }
    });
});
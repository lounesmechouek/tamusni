$("document").ready(() => {
    $("#add_artc").on("click", () => {
        $(".wsp-add-popup").fadeIn(300);
    })
    $("#annulAjout").on("click", () => {
        $(".wsp-add-popup").fadeOut(300);
    })
    $("#ajoutArticle").on("click", () => {
        if( $("#art_title").val() && $("#corps_article").val()){
            window.alert("Article ajouté avec succès ! (Rafrîchir pour voir les changements)");
            $(".wsp-add-popup").fadeOut(300);
        }else{
            window.alert("Veuillez remplir l'ensemble des champs obligatoires");
        }
    })

    $("#del_artc").on("click", () => {
        $(".wsp-del-popup").fadeIn(300);
    })
    $("#annulsup").on("click", () => {
        $(".wsp-del-popup").fadeOut(300);
    })
    $("#suppArticle").on("click", () => {
        if( $("#art_del").val()){
            window.alert("Article supprimé avec succès ! (Rafrîchir pour voir les changements)");
            $(".wsp-del-popup").fadeOut(300);
        }else{
            window.alert("Veuillez choisir un article !");
        }
    })

    $("#add_pres").on("click", () => {
        $(".wsp-pres-add-popup").fadeIn(300);
    })
    $("#annulPres").on("click", () => {
        $(".wsp-pres-add-popup").fadeOut(300);
    })
    $("#ajoutPres").on("click", () => {
        if($("#pres_title").val() && $("#corps_pres").val()){
            window.alert("Élèment ajouté avec succès ! (Rafrîchir pour voir les changements)");
            $(".wsp-pres-add-popup").fadeOut(300);
        }else{
            window.alert("Veuillez remplir les champs obligatoires");
        }
    })

    $("#del_pres").on("click", () => {
        $(".wsp-pres-del-popup").fadeIn(300);       
    })
    $("#annulSuppPr").on("click", () => {
        $(".wsp-pres-del-popup").fadeOut(300); 
    })
    $("#suppPres").on("click", () => {
        $(".wsp-pres-del-popup").fadeOut(300); 
        window.alert("Article supprimé avec succès ! (Rafrîchir pour voir les changements)");
    })

    $("#add_usr").on("click", () => {
        $(".up-usrs-add").fadeIn(300);
    })
    $("#annulUsr").on("click", () => {
        $(".up-usrs-add").fadeOut(300);
    })
    $("#ajoutUsr").on("click", () => {
        if($("#usrname").val() && $("#passwd").val() && $("#nameusr").val() && $("#prenomusr").val() && $("#birthdate").val() && $("#email").val()){
            window.alert("L'utilisateur a été ajouté avec succès ! (Rafrîchir pour voir les changements)");
        }else{
            window.alert("Veuillez remplir les informations obligatoires");
        }
        $(".up-usrs-add").fadeOut(300);
    })

    $("#del_usr").on("click", () => {
        $(".up-usrs-del").fadeIn(300);
    })
    $("#annulSuppUsr").on("click", () => {
        $(".up-usrs-del").fadeOut(300); 
    })
    $("#suppUsr").on("click", () => {
        $(".up-usrs-del").fadeOut(300); 
        window.alert("Utilisateur supprimé avec succès ! (Rafrîchir pour voir les changements)");
    })
    
})

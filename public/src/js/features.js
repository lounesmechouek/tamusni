$(document).ready(function(){
    $.ajax({
        url: ".\\src\\js\\features.json", //On suppose que l'appel est toujours fait depuis le dossier "public\"
        dataType: "json",
        async: true,

        success: function(data){
            let titre, image, pageName, row = 0, pa = $("#actualpage").html();
            $.each(data, function(key, val){
                //On vérifie que le type d'utilisateur correspond et qu'on est bien au niveau du dashboard
                if(key === $("#typeuser").html() && pa === $("#typeuser").html() + ".dashboard"){
                    for(let i=0; i<val.length; i++){
                        if(row === 0){
                            $("<div class='row-container'>").appendTo(".addh-container");
                        }
                        $.each(val[i], function(cle, valeur){
                            if(cle === "title"){
                                titre = valeur;
                            }else if(cle === "image"){
                                image = valeur;
                            }else if(cle === "pageName"){
                                pageName = valeur;
                            }
                        });

                        $("<a href='?page="+pageName+"' class='addh-elt-container'><div><img class='addh-elt-img' src='"+ image +"' /></div><div><p class='addh-elt-txt'>"+ titre +"</p></div></a>").appendTo(".addh-container > div:last");
                        row++;

                        if(row>=4){
                            $("</div>").appendTo(".addh-container");
                            row=0;
                        }
                    }
                }
            });
        },

        statusCode: {
            404: function(){
                alert("Il y a eu un problème lors de la récupération des fonctionnalités");
            }
        }
    });
});
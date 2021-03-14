$(document).ready(function(){
    $.ajax({
        url: ".\\src\\js\\online-menu.json", //On suppose que l'appel est toujours fait depuis le dossier "public\"
        dataType: "json",
        async: true,

        success: function(data){
            let titre, path, pageName, pa = $("#actualpage").html();
            $.each(data, function(key, val){
                //On vérifie que le type d'utilisateur correspond
                if(key === $("#typeuser").html()){
                    for(let i=0; i<val.length; i++){
                        $.each(val[i], function(cle, valeur){
                            if(cle === "title"){
                                titre = valeur;
                            }else if(cle === "path"){
                                path = valeur;
                            }else if(cle === "pageName"){
                                pageName = valeur;
                            }
                        });

                        if(pageName === pa){
                            $("<a href='?page="+pageName+"' class='sb-elt-container selected'><img class='sb-elt-icon' src='"+ path +"' /><p class='sb-elt-txt'>"+ titre +"</p></a>").appendTo(".sb-nav-container");
                        }else{
                            $("<a href='?page="+pageName+"' class='sb-elt-container'><img class='sb-elt-icon' src='"+ path +"' /><p class='sb-elt-txt'>"+ titre +"</p></a>").appendTo(".sb-nav-container");
                        }


                    }
                }
            });
        },

        statusCode: {
            404: function(){
                alert("Il y a eu un problème avec la récupération du menu");
            }
        }
    });
});
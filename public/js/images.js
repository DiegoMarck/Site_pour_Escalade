window.onload = () => {
    // Gestion des boutons "Supprimer"
    let links = document.querySelectorAll("[data-delete]")
    
    // On boucle sur links
    for(link of links){
        // On écoute le clic
        link.addEventListener("click", function(e){
            // On empêche la navigation
            e.preventDefault()

            // On demande confirmation
            if(confirm("Voulez-vous supprimer cette image ?")){
                // On envoie une requête Ajax vers le href du lien avec la méthode DELETE
                fetch(this.getAttribute("href"), {//le fetch parmet d'envoyer à l'url le token. Fetch fonctionne comme une promesse -> .then
                    method: "DELETE",//methode
                    headers: {//informations envoyées en entête
                        "X-Requested-With": "XMLHttpRequest",//requête en XML...
                        "Content-Type": "application/json"//type de contenu envoyé -> json
                    },
                    body: JSON.stringify({"_token": this.dataset.token})//les données, tableau convertit en json avec un token. //this-> lien sur lequel on clic. Puis je cherche dans les datas du lien sur le quel je clique, celui qui s'appelle token
                }).then(
                    // On récupère la variable reponse en JSON avec la fonction response
                    response => response.json()//est une promesse aussi
                ).then(data => {//on a nos données
                    if(data.success)//si data contient success
                        this.parentElement.remove()//supprime l'élément parent du lien
                    else
                        alert(data.error)//sinon error
                }).catch(e => alert(e))//si disfonctionnement
            }
        })
    }
}
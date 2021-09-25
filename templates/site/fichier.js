function capitalize(str){
    return str[0].toUpperCase() + str.slice(1);
}

function main(){

    //choper l'adresse ip du pc qui ouvre la page
    const resultat = fetch('http://api.ipify.org?format=json')
        .then(resultat => console.log(resultat))
    console.log('resultat');
                //choper la ville grace à l'ip
                //Choper les infos meteo grace à la ville : 
}

main();
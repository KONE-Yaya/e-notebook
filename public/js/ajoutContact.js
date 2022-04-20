var btValiderForm = document.getElementById('idbtValiderAjoutContact');
var vTel = document.getElementById.innerHTML('tel');
var vEmail = document.getElementById.innerHTML('email');
var masqueEmail = /^(([^<()[\]\\.,;:\s@\]+(\.[^<()[\]\\.,;:\s@\]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
var masqueTel = /[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}/;


btValiderForm.addEventListener('click', controleDeDonnes);

function controleDeDonnes(evenement){
    /*Si (if...) les données ne remplissent pas certaines conditions, renvoie un
    message et empêche l'action par défaut du clic = l'envoie du formulaire*/
    alert('Envoi du formulaire bloqué');
    evenement.preventDefault();
    if(!masqueEmail.test(vEmail)){
        evenement.preventDefault();
        vEmail.style.border.color='red';
    }

    if(!masqueTel.test(vTel)){
        evenement.preventDefault();
        vTel.style.border.color='red';
    }
}
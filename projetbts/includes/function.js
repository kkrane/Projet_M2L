function errorJs(champ, erreur) {
    
    if (erreur) {
        champ.style.border = "3px solid #fba";
        document.getElementById('alertErr').style.display = '';
    }
    else {
        champ.style.border = "0px solid #fba";
        document.getElementById('alertErr').style.display = 'none';   
    }
}
    
function errorJsCo(champ, erreur) {
    
    if (erreur) {
        champ.style.border = "3px solid #fba";
        document.getElementById('alertErr2').style.display = '';
    }
    else {
        champ.style.border = "0px solid #fba";
        document.getElementById('alertErr2').style.display = 'none';   
    }
}

function verifName (champ)
{
    var regex = /^[- A-Za-zàâäéèêëïîôöùûü\']{2,}$/;
    
    if(champ.value.length == 0)
    {
        errorJs(champ,true);
        document.getElementById('errMsg').innerHTML = "Veuillez renseigner votre nom";
        return false;
    }
    
    else if(champ.value.length < 2 || champ.value.length > 30 && champ.value.length != 0 || !regex.test(champ.value)){
        errorJs(champ,true);
        document.getElementById('errMsg').innerHTML = "Votre nom ne peut contenir de chiffre ni de caractère spéciaux et doit faire plus de 2 lettres";
        return false;
    }
    else {
        errorJs(champ,false);
        return true;
    }
}

function verifFirstName (champ)
{
    var regex = /^[- A-Za-zàâäéèêëïîôöùûü\']{2,}$/;
    
    if(champ.value.length == 0)
    {
        errorJs(champ,true);
        document.getElementById('errMsg').innerHTML = "Veuillez renseigner votre prénom";
        return false;
    }
    
    else if(champ.value.length < 2 || champ.value.length > 30 && champ.value.length !== 0 || !regex.test(champ.value)){
        errorJs(champ,true);
        document.getElementById('errMsg').innerHTML = "Votre prénom ne peut contenir de chiffre ni de caractère spéciaux et doit faire plus de 2 lettres";
        return false;
    }
    else {
        errorJs(champ,false);
        return true;
    }
}

function verifMail(champ)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    
    if(champ.value.length == 0)
    {
        errorJs(champ,true);
        document.getElementById('errMsg').innerHTML = "Veuillez renseigner votre email";
        return false;
    }
    
    if(!regex.test(champ.value)){
        errorJs(champ, true);
        document.getElementById('errMsg').innerHTML = "Votre mail n'est pas valide";
        return false;
    }
    else
    {
        errorJs(champ,false);
        return true;
    }
        
}

function verifLogin (champ)
{    
    if(champ.value.length == 0)
    {
        errorJs(champ,true);
        document.getElementById('errMsg').innerHTML = "Veuillez choisir votre identifiant";
        return false;
    }
    else {
        errorJs(champ,false);
        return true;
    }
}

function verifMdp()
{
    var mdp1 = document.getElementById("mdp");
    var mdp2 = document.getElementById("mdp2");
    var alert = document.getElementById("errMsg");
    
    if(mdp1.value == 0 || mdp1.value == null || mdp1.value.length < 6)
    {
        alert.innerHTML = "Veuillez choisir un mot de passe de plus de 6 caractères minimum";
        errorJs(mdp1, true);
        errorJs(mdp2, true);
        return false;
    }
    else if(mdp2.value == 0 || mdp2.value == null)
    {
        alert.innerHTML = "Veuillez confirmer votre mot de passe";
        errorJs(mdp1, true);
        errorJs(mdp2, true);
        return false;    
    }
    else if(mdp1.value != mdp2.value)
    {
        alert.innerHTML = "Votre mot de passe ne correspond pas";
        errorJs(mdp1, true);
        errorJs(mdp2, true);
        return false;
    }
    else
    {
        errorJs(mdp1, false);
        errorJs(mdp2 , false);
        return true;
    }
}
    
function verifCoLogin(champ)
{
        if(champ.value.length == 0)
    {
        errorJsCo(champ,true);
        document.getElementById('errMsg2').innerHTML = "Veuillez renseigner votre identifiant";
        return false;
    }
    else {
        errorJsCo(champ,false);
        return true;
    }
}
    
function verifCoMdp(champ)
{
        if(champ.value.length == 0)
    {
        errorJsCo(champ,true);
        document.getElementById('errMsg2').innerHTML = "Veuillez renseigner votre mot de passe";
        return false;
    }
    else {
        errorJsCo(champ,false);
        return true;
    }
}
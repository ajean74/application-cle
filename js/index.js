function DeletePopUp(){
    document.getElementById("popup").remove();
    window.location.replace("utilisateur.php");
}

document.querySelector("#valider").addEventListener('click', DeletePopUp);
document.querySelector("#annuler").addEventListener('click', DeletePopUp);
document.querySelector("#rentrer").addEventListener('click', DeletePopUp);


 /*function printData()
{
   var divToPrint=document.getElementById("exemple");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}*/

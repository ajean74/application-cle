$(document).ready(function() {
    $('#exemple').DataTable({
        "language": {
            "lengthMenu": "Afficher _MENU_ éléments",
            "zeroRecords": "Aucune donnée ne correspond à votre recherche.",
            "info": "Affichage de _PAGE_ à _PAGES_",
            "infoEmpty": "Aucun donnée disponible",
            "infoFiltered": "(filtré à partir de _MAX_ enregistrements au total)",
            "search": "Rechercher :",
            "paginate": {
                "first":      "Premier",
                "last":       "Dernier",
                "next":       "Suivant",
                "previous":   "Précédent"
            }
        }
    });
});
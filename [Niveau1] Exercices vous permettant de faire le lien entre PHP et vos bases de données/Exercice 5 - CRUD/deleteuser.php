
<?php 
include "database.php";
 
$database->delete("utilisateurs","*", ['id'= $id]);

    echo '<script type="text/javascript">';
    echo 'alert(" Cet utilisateur est supprimé !")'; 
    echo '</script>';

?>



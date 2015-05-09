<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//pagina va afisa o lista de drepturi cu posbilitatea de adaugare 
//pentru utilizatorul selectat a unui anumit drept sau de stergere
include '/../library/class/User.php';

?>
<h2> Drepturi disponibile: </h2>
<?php      
        $permissions = User::getUserRights($_GET['id']);
        foreach ($permissions as $permission) {
        ?>
        <table width="500" border="1">
        <tr><?php print $permission; ?></tr>
        </table>           
        <?php
        }
        ?>
<p>TO DO: butoane cu adaugari de drepturi</p>   
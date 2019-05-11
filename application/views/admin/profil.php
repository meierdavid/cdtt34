<?php if($isAdmin){?><h2>Profil de<?php echo $admin[0]->prenomAdmin . " " . $admin[0]->nomAdmin; ?></h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Licence</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Classement début de saison</th>
            <th scope="col">Classement actuel</th>
            
            <th scope="col">Modifier</th>
           
        </tr>
    </thead>
    <tbody> 
        <tr>
            <td><?php echo $admin[0]->idAdmin; ?></td>
            <td><?php echo $admin[0]->nomAdmin; ?></td>
            <td><?php echo $admin[0]->prenomAdmin; ?></td>
            <td><?php echo $admin[0]->classementAdmin; ?></td>
            <td><?php echo $admin[0]->classementProvisoireAdmin; ?></td>
            <?php if($isAdmin){?>
            
            <td><p><a href="<?php echo base_url("Admin/update/" . $admin[0]->idAdmin); ?>">Modifier le client</a></p></td>
            <?php } ?>
        </tr>
    </tbody>
</table>
 <?php } ?>
<h1>Historique des matchs</h1>
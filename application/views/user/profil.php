<h2>Profil de<?php echo $user[0]->prenomUser . " " . $user[0]->nomUser; ?></h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Licence</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Classement début de saison</th>
            <th scope="col">Classement actuel</th>
            <?php if ($isAdmin) { ?>
                <th scope="col">Supprimer</th>
                <th scope="col">Modifier</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody> 
        <tr>
            <td><?php echo $user[0]->idUser; ?></td>
            <td><?php echo $user[0]->nomUser; ?></td>
            <td><?php echo $user[0]->prenomUser; ?></td>
            <td><?php echo $user[0]->classementUser; ?></td>
            <td><?php echo $user[0]->classementProvisoireUser; ?></td>
            <?php if ($isAdmin) { ?>
                <td><p><a href="<?php echo base_url("User/delete/" . $user[0]->idUser); ?>">Supprimer le client</a></p></td>
                <td><p><a href="<?php echo base_url("User/update/" . $user[0]->idUser); ?>">Modifier le client</a></p></td>
            <?php } ?>
        </tr>
    </tbody>
</table>

<h1>Historique des matchs</h1>

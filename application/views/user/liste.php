<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Joueurs</h2>
                            <div class="row">
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered ">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Licence</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Classement début de saison</th>
                                                    <th scope="col">Classement actuel</th>
                                                    
                                                    <?php if($isAdmin){?>
                                                    <th scope="col">Supprimer</th>
                                                    <?php } ?>
                                                    <th scope="col">Profil</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($user as $item) { ?>
                                                        <td><?php echo $item->idUser; ?></td>
                                                        <td><?php echo $item->nomUser; ?></td>
                                                        <td><?php echo $item->prenomUser; ?></td>
                                                        <td><?php echo $item->classementUser; ?></td>
                                                        <td><?php echo $item->classementProvisoireUser; ?></td>
                                                        <?php if($isAdmin){?>
                                                        <td><p><a id= "supprimer" href="<?php echo base_url("User/delete/" . $item->idUser); ?>" onclick="return(validate())">Supprimer le client</a></p></td>
                                                        <?php } ?>
                                                        <td><p><a href="<?php echo base_url("User/profil/" . $item->idUser); ?>">Voir le profil</a></p></td>
                                                        
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                     <?php if($isAdmin){?>
                                    <div class="text-center mb-3">
                                        <a class="btn btn-primary" href="<?php echo base_url('user/create');?>" role="button">Ajouter un joueur</a>
                                    </div>
                                    <?php } ?>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

        </div>
    </div>
</div>


<script>
    function validate()
    {
        
     
        var r = confirm(" êtes-vous sur de supprimer ce joueur ?")
        if (r == true)
            return true;
        else
            return false;
    }
</script>

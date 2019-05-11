<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Tournois</h2>
                            
                            <div class="row">
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered ">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <?php if($isAdmin){?>
                                                    <th scope="col">Supprimer</th>
                                                    <th scope="col">Modifier</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($tournoi as $item) { ?>
                                                    
                                                        <td><?php echo $item->nomTournoi; ?></td>
                                                        <?php if($isAdmin){?>
                                                        <td><p><a href="<?php echo base_url("tournoi/delete/" . $item->numTournoi); ?>">Supprimer le tournoi</a></p></td>
                                                        <td><p><a href="<?php echo base_url("tournoi/update/" . $item->numTournoi); ?>">modifier</a></p></td>
                                                        <?php }?>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if($isAdmin){?>
                                    <div class="text-center mb-3"><a class="btn btn-primary" href="<?php echo base_url('tournoi/create')?>" role="button">Créer un tournoi</a></div>
                                    <?php }?>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

        </div>
    </div>
</div>




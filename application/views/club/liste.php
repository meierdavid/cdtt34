<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Clubs</h2>
                            
                            <div class="row">
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
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
                                                    <?php foreach ($club as $item) { ?>
                                                    
                                                        <td><?php echo $item->nomClub; ?></td>
                                                        <?php if($isAdmin){?>
                                                        <td><p><a href="<?php echo base_url("club/delete/" . $item->numClub); ?>">Supprimer le club</a></p></td>
                                                        <td><p><a href="<?php echo base_url("club/update/" . $item->numClub); ?>">modifier</a></p></td>
                                                    <?php } ?>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if($isAdmin){?>
                                    <div>
                                        <a class="btn btn-primary" href="<?php echo base_url('club/create');?>" role="button">Créer un club</a>
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




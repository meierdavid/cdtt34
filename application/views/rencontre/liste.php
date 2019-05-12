<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Rencontres</h2>
                            
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
                                                    <?php foreach ($rencontre as $item) { ?>
                                                    
                                                        <td><?php echo $item->numGagnant; ?></td>
                                                        <?php if($isAdmin){?>
                                                        <td><p><a id="suprimer" href="<?php echo base_url("rencontre/delete/" . $item->numRencontre); ?>" onclick="return(validate())">Supprimer le rencontre</a></p></td>
                                                        <td><p><a href="<?php echo base_url("rencontre/update/" . $item->numRencontre); ?>">modifier</a></p></td>
                                                    <?php }?>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                     <?php if($isAdmin){?>
                                    <div><a class="btn btn-primary" href="<?php echo base_url('rencontre/create')?>" role="button">Créer un rencontre</a></div>
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
        
     
        var r = confirm(" êtes-vous sur de supprimer ce match ?\n\
                            Attention les classements des joueurs ne sont pas réinitialisé")
        if (r == true)
            return true;
        else
            return false;
    }
</script>

<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                             <?php if(isset($message)){
                                
                                echo "<p class=\"text-warning\">".$message."</p>";
                            }
                            ?>
                            <h2>Liste des Tournois</h2>
                            
                            <div class="row">
                                <?php if ($isAdmin) { ?>
                                        <div class="text-center ml-3 mb-3"><a class="btn btn-primary" href="<?php echo base_url('tournoi/create') ?>" role="button">Créer un tournoi</a></div>
                                    <?php } ?>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive mb-3">
                                        <table id="table" class="table table-striped table-bordered text-center ">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <?php if ($isAdmin) { ?>
                                                        <th scope="col">Supprimer</th>
                                                        <th scope="col">Modifier</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tournoi as $item) { ?>
                                                    <tr>
                                                        <td><?php echo $item->nomTournoi; ?></td>
                                                        <?php if ($isAdmin) { ?>
                                                            <td><p><a id="supprimer" href="<?php echo base_url("tournoi/delete/" . $item->numTournoi); ?>" onclick="return(validate())"><img src="<?php echo base_url("assets/image/delete.png"); ?>"></a></p></td>
                                                            <td><p><a href="<?php echo base_url("tournoi/update/" . $item->numTournoi); ?>"><img src="<?php echo base_url("assets/image/update.png"); ?>"></a></p></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
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


        var r = confirm(" êtes-vous sur de supprimer ce tournoi ?")
        if (r == true)
            return true;
        else
            return false;
    }

    $(document).ready(function () {
        $('#table').DataTable({
            "searching": true, 
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>

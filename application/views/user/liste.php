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
                            <h2>Liste des Joueurs</h2>
                            <div class="row">
                                <?php if ($isAdmin) { ?>
                                        <div class="text-center ml-3 mb-3">
                                            <a class="btn btn-primary" href="<?php echo base_url('user/create'); ?>" role="button">Ajouter un joueur</a>
                                        </div>
                                <?php } ?>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped table-bordered text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Licence</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Classement début de saison</th>
                                                    <th scope="col">Classement actuel</th>
                                                    <th scope="col">Date de naissance</th>
                                                    <th scope="col">Club</th>

                                                    <?php if ($isAdmin) { ?>
                                                        <th scope="col">Supprimer</th>
                                                        <th scope="col">Modifier</th>
                                                    <?php } ?>

                                                </tr>
                                            </thead>
                                            <tbody><?php $i = 0;
                                                    foreach ($user as $item) {
                                                        ?>
                                                    <tr>

                                                        <td><?php echo $item->idUser; ?></td>
                                                        <td><a  href="<?php echo base_url("User/profil/" . $item->idUser); ?>"><?php echo $item->nomUser; ?></a></td>
                                                        <td ><a  href="<?php echo base_url("User/profil/" . $item->idUser); ?>"><?php echo $item->prenomUser; ?></a></td>
                                                        <td><?php echo $item->classementUser; ?></td>
                                                        <td><?php echo $item->classementProvisoireUser; ?></td>
                                                        <td><?php echo $item->dateDeNaissance; ?></td>
                                                        <td><a  href="<?php echo base_url("club/joueurs/" . $clubs[$i]['numClub']); ?>"><?php echo $clubs[$i]['nomClub'] ?></a></td>
    <?php if ($isAdmin) { ?>
                                                            <td><p><a id= "supprimer" href="<?php echo base_url("User/delete/" . $item->idUser); ?>" onclick="return(validate())"><img src="<?php echo base_url("assets/image/delete.png"); ?>"></a></p></td>
                                                            <td><p><a id= "supprimer" href="<?php echo base_url("User/update/" . $item->idUser); ?>"><img src="<?php echo base_url("assets/image/update.png"); ?>"></a></p></td>

    <?php } ?>

                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
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


        var r = confirm(" êtes-vous sur de supprimer ce joueur ?")
        if (r == true)
            return true;
        else
            return false;
    }

    $(document).ready(function () {
        $('#table').DataTable({
            "searching": true, // false to disable search (or any other option)
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>

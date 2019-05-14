<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Rencontres</h2>

                            <?php if (isset($historique)) { ?>
                                <div class="row">
                                    <article class=" col-md-11 col-lg-11">
                                        <div class="table-responsive">
                                            <table id="table" class="table table-striped table-bordered  text-center">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Vainqueur</th>
                                                        <th scope="col">Point du vainqueur</th>
                                                        <th scope="col">Perdant</th>
                                                        <th scope="col">Point du perdant</th>
                                                        <?php if($isAdmin){?>
                                                        <th scope="col">Supprimer</th>
                                                        <?php }?>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($historique as $item) {
                                                       ?>
                                                    <tr>


                                                    <td><?php echo $item['date']; ?></td>
                                                    <td><a href="<?php echo base_url("User/profil/" . $item['numGagnant']); ?>"><?php echo $item['nomGagnant']; ?></a></td>
                                                    <td><?php echo $item['pointGagnant']; ?></td>
                                                    <td><a href="<?php echo base_url("User/profil/" . $item['numPerdant']); ?>"><?php echo $item['nomPerdant'] ?></a></td>
                                                    <td><?php echo $item['pointPerdant']; ?></td>
                                                    <td>
                                                        <a id="supprimer" href="<?php echo base_url("rencontre/delete/" . $item['numRencontre']); ?>" onclick="return(validate())"><img src="<?php echo base_url("assets/image/delete.png")?>"></a>
                                                    </td>
                                                    
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </article>
                                </div>
                            <?php
                            } else {
                                echo "<div> <span>Il n'y a aucun match dans l'historique </span</div>";
                            }
                            ?>

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


        var r = confirm(" Etes-vous sur de supprimer ce match ?\n\ Attention les classements des joueurs seront modifié en conséquence !")
        if (r == true)
            return true;
        else
            return false;
    }

    $(document).ready(function () {
        $('#table').DataTable({
            "searching": true // false to disable search (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>

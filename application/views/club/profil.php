
<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">

                            <div class="row">
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <h2><?php echo $club[0]->nomClub; ?></h2>
                                        <table id ="table" class="table table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Licence</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Classement début de saison</th>
                                                    <th scope="col">Classement actuel</th>
                                                    <th scope="col">Date de naissance</th>
                                                    <th scope="col">Profil</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php $i = 0;
                                                foreach ($joueurs as $item) {
                                                    ?>
                                                    <tr>

                                                        <td><?php echo $item->idUser; ?></td>
                                                        <td><a  href="<?php echo base_url("User/profil/" . $item->idUser); ?>"><?php echo $item->nomUser; ?></a></td>
                                                        <td ><a  href="<?php echo base_url("User/profil/" . $item->idUser); ?>"><?php echo $item->prenomUser; ?></a></td>
                                                        <td><?php echo $item->classementUser; ?></td>
                                                        <td><?php echo $item->classementProvisoireUser; ?></td>
                                                        <td><?php echo $item->dateDeNaissance; ?></td>
                                                        <td><p><a href="<?php echo base_url("User/profil/" . $item->idUser); ?>">Voir le profil</a></p></td>

                                                    </tr><?php } ?>
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

    $(document).ready(function () {
        $('#table').DataTable({
            "searching": true // false to disable search (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
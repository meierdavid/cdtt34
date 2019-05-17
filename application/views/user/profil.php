<div class="container text-center">
<h2><?php echo $user[0]->prenomUser . " " . $user[0]->nomUser; ?></h2>            
<p>Licence</p>                                    
<p><?php echo $user[0]->idUser; ?></p>
<p>Classement début de saison</p>
<p><?php echo $user[0]->classementUser; ?></p>
<p>Classement actuel</p>
<p><?php echo $user[0]->classementProvisoireUser; ?></p>
<p>Date de Naissance</p>
<p><?php echo $user[0]->dateDeNaissance; ?></p>
</div>

<h1>Historique des matchs</h1>
<?php if (isset($historique)) { ?>
    <div class="row">
        <article class=" col-md-11 col-lg-11">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Vainqueur</th>
                            <th scope="col">Point du vainqueur</th>
                            <th scope="col">Perdant</th>
                            <th scope="col">Point du perdant</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($historique as $item) {
                            if ($item['numGagnant'] == $user[0]->idUser) {
                                echo "<tr class=\"bg-success\">";
                            } else {
                                echo "<tr class=\"bg-warning\">";
                            }
                            ?>



                        <td><?php echo $item['date']; ?></td>
                        <td><a class="text-white" href="<?php echo base_url("User/profil/" . $item['numGagnant']); ?>"><?php echo $item['nomGagnant']; ?></a></td>
                        <td><?php echo $item['pointGagnant']; ?></td>
                        <td><a class="text-white"  href="<?php echo base_url("User/profil/" . $item['numPerdant']); ?>"><?php echo $item['nomPerdant'] ?></a></td>
                        <td><?php echo $item['pointPerdant']; ?></td>

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

<script>

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

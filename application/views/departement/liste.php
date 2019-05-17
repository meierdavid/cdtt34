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
                            <h2>Liste des Départements</h2>
                               
                            <div class="row">
                                <?php if ($isAdmin) { ?>
                                        <div class="text-center mb-3 ml-3">
                                            <a class="btn btn-primary " href="<?php echo base_url('departement/create'); ?>" role="button">Créer un département</a>
                                        </div>
                                    <?php } ?>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive mb-3">
                                        <table  id="table" class=" table table-striped table-bordered  text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Numero</th>
                                                    <?php if ($isAdmin) { ?>
                                                        <th   scope="col">Supprimer</th>
                                                        <th scope="col">Modifier</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($departement as $item) { ?>

                                                    <td><a href="<?php echo base_url("departement/clubs/" . $item->numDepartement); ?>"><?php echo $item->nomDepartement; ?></a></td>
                                                        <td><?php echo $item->numeroDepartement; ?></td>
                                                        <?php if ($isAdmin) { ?>
                                                            <td>
                                                                <a id="supprimer" href="<?php echo base_url("departement/delete/" . $item->numDepartement); ?>" onclick="return(validate())"><img src="<?php echo base_url("assets/image/delete.png") ?>"></a>
                                                            </td>
                                                            <td><a href="<?php echo base_url("departement/update/" . $item->numDepartement); ?>"><img src="<?php echo base_url("assets/image/update.png") ?>"></a></td>
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


        var r = confirm(" êtes-vous sur de supprimer ce departement ?")
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
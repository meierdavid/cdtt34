
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
                                        <h2><?php echo $departement[0]->nomDepartement; ?></h2>
                                        <table id ="table" class="table table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">nombres de joueurs</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php foreach ($clubs as $item) { ?>
                                                    <tr>
                                                        <td><a  href="<?php echo base_url("club/joueurs/" . $item->numClub); ?>"><?php echo $item->nomClub; ?></a></td>
                                                        <td> attributs nombre de joueurs à rajouter</td>

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

    $(document).ready(function () {
        $('#table').DataTable({
            "searching": true // false to disable search (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
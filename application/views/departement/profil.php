
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
                                                    
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php foreach ($clubs as $item) { ?>
                                                    <tr>
                                                        <td><a  href="<?php echo base_url("club/joueurs/" . $item->numClub); ?>"><?php echo $item->nomClub; ?></a></td>
                                                     
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
            "searching": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
 <?php if ($isAdmin) { ?>
<div class="container-fluid">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Administrateurs</h2>
                            <div class="row">
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table  id="table" class=" table table-striped table-bordered text-center ">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">mail</th>
                                                    <th scope="col">Supprimer</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        
                                                        foreach ($administrateur as $item) { ?>

                                                        <td><?php echo $item->mail; ?></td>
                                                        
                                                        <td><a id="supprimer" href="<?php echo base_url("administrateur/delete/" . $item->id); ?>" onclick="return(validate())"><img src="<?php echo base_url("assets/image/delete.png");?>"></a></td>
                                                    
                                                
                                                </tr>
                                            <?php 
                                                    
                                                        } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                        <div class="text-center mb-3">
                                            <a class="btn btn-primary " href="<?php echo base_url('administrateur/create'); ?>" role="button">Créer un administrateur</a>
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

<?php } ?>

<script>
    function validate()
    {


        var r = confirm(" êtes-vous sur de supprimer cet administrateur ?")
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
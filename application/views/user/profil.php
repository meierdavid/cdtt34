<h2>Profil de<?php echo $user[0]->prenomUser . " " . $user[0]->nomUser; ?></h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Licence</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Classement début de saison</th>
            <th scope="col">Classement actuel</th>
            <th scope="col">Date de Naissance</th>

        </tr>
    </thead>
    <tbody> 
        <tr>
            <td><?php echo $user[0]->idUser; ?></td>
            <td><?php echo $user[0]->nomUser; ?></td>
            <td><?php echo $user[0]->prenomUser; ?></td>
            <td><?php echo $user[0]->classementUser; ?></td>
            <td><?php echo $user[0]->classementProvisoireUser; ?></td>
            <td><?php echo $user[0]->dateDeNaissance; ?></td>
        </tr>
    </tbody>
</table>

<h1>Historique des matchs</h1>
<?php if(isset($historique)){ ?>
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
                    <?php  foreach ($historique as $item) { 
                        if($item['numGagnant'] == $user[0]->idUser){
                            echo "<tr class=\"bg-success\">";
                        }
                        else{
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
<?php }
else{
    echo "<div> <span>Il n'y a aucun match dans l'historique </span</div>";
    
} ?>

<script>
    
       $(document).ready(function () {
        $('#table').DataTable({
            "searching": true // false to disable search (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>

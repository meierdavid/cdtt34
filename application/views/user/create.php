

<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div> 
        <?php echo form_open('user/create'); ?>
        <div class="form-group">
            <label for="create_num_licence" class="control-label">Numéro de licence</label>
            <input id="create_num_licence" type="text" class="form-control" name="idUser"  value="" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_nom_joueur" class="control-label">Nom du joueur</label>
            <input id="create_nom_joueur" type="text" class="form-control" name="nomUser"  value="" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_prenom_joueur" class="control-label">Prénom du joueur</label>
            <input id="create_prenom_joueur" type="text" class="form-control" name="prenomUser"  value="" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_classement_joueur" class="control-label">Classement du joueur</label>
            <input id="create_classement_joueur" type="numeric" class="form-control" name="classementUser"  value="" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_classementP_joueur" class="control-label">Classement provisoire du joueur</label>
            <input id="create_classementP_joueur" type="numeric" class="form-control" name="classementProvisoireUser"  value="" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_dateDeNaissance" class="control-label" >date de naissance :</label>
            <input id="create_dateDeNaissance" class=" bg-light " name="dateDeNaissance" type="date" value="">
        </div>
        <div id="select-club">


        </div>


        <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

        </form>  
    </div>
</div>
<script>
    $(document).ready(function () {

        remplissage_Club();


    });
    function remplissage_Club() {

        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url('club/findAll') ?>',
            async: true,
            dataType: 'json',
            success: function (data) {

                var html = '<label for="select-club">Choisir un club :</label>';
                html += '<select name="nomClub" id="select-club" required >';
                html += '<option value="">--Selectionner un club--</option>';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].nomClub + '">' + data[i].nomClub + '</option>';

                }
                html += '</select>';
                $('#select-club').html(html);
            }


        });

    }



</script>
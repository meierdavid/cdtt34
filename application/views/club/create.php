

<div class="container" align="left">
    <div style=" margin-top: 20%">
    <div class="row ml-auto">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div> 
        <?php echo form_open("club/create"); ?>
        <h2>Création d'un club</h2>
        <div class="form-group">
            <label for="create_nom_club" class="control-label">Nom du club</label>
            <input id="create_nom_club" type="text" class="form-control" name="nomClub"  value="" size="30" required /> 
        </div>
        <div id="select-departement">


        </div>
        <div class="text-center"><button class="btn btn-primary" type="submit" >créer</button></div>

        </form>  
    </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        remplissage_Club();


    });
    function remplissage_Club() {

        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url('departement/findAll') ?>',
            async: true,
            dataType: 'json',
            success: function (data) {

                var html = '<label for="select-departement">Choisir un Departement </label>';
                html += '<select name="nomDepartement" id="select-departement" required >';
                html += '<option value="">--Selectionner un departement--</option>';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].nomDepartement + '">' + data[i].nomDepartement + '</option>';

                }
                html += '</select>';
                $('#select-departement').html(html);
            }


        });

    }



</script>
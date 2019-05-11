
<!doctype html>
<div class="container login-container2 " align="left">

   
    <div class="row">
        <div >
            <h1>Saisir une rencontre</h1>
        </div>
    </div>

    <form method="post" accept-charset="utf-8" action="<?php base_url('rencontre/create') ?>">
        <div class="form-group">
            <div class="row">
                <div class="mb-3">
                    
                    <label class="h4" for="date">* date :</label>
                    <input class=" bg-info " name="date" type="date">
                    <div class="error notification text-danger is-danger"><?php echo form_error('date'); ?> </div>
                </div>
            </div>
            <div class="row">
                <div>
                        
                    <div class="mb-3" id="select-tournoi">
                        </div>
                    </div>
            </div>
                    
            
            
            
            <div class='bg-primary row mb-3'>
                <div class="col-sm-6 col-lg-6 col-md-6" >
                    <h1>Gagnant</h1>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6" >
                    <h1>Perdant</h1>
                </div>
            </div>
            <div class="row mb-3 mb-3">
                <div class="col-sm-6 col-lg-6 col-md-6 bg-info ">
                    <label class="control-label">Licence</label>
                    
                    <input type="number" class="form-control " name="numGagnant"  value="" size="30" required />
                    
                    <label  class="control-label">Nom</label>
                    <input id="recherche-nom-Gagnant" type="text" class="form-control recherche-nom" name="nomGagnant"  value="" size="30" required />
                    <div class="error notification text-danger is-danger "><?php echo form_error('nomGagnant'); ?> </div>
                    <label class="control-label">Prénom</label>
                    <input id="recherche-prenom-Gagnant" type = "text" class="form-control" name="prenomGagnant"  value="" size="30" required />
                    <div class="error notification text-danger is-danger"><?php echo form_error('prenomGagnant'); ?> </div>
                </div>


                <div class="col-sm-6 col-lg-6 col-md-6 bg-info" >
                    <label class="control-label">Licence</label>
                    <input type="number" class="form-control" name="numPerdant"  value="" size="30" required />
                    <label class="control-label">Nom</label>
                    <input id="recherche-nom-Perdant" type="text" class="form-control" name="nomPerdant"  value="" size="30" required />
                    <div class="error notification text-danger is-danger"><?php echo form_error('nomPerdant'); ?> </div>
                    <label class="control-label">Prénom</label>
                    <input id="recherche-prenom-Perdant" type="text" class="form-control" name="prenomPerdant"  value="" size="30" required />
                    <div class="error notification text-danger is-danger"><?php echo form_error('prenomPerdant'); ?> </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-3">
            <input class="btn btn-success" type="submit" value="créer" />
        </div>

    </form>  

</div>

<script>
     $(document).ready(function() {
         
        remplissage_Tournoi();
         
         
     });
     function remplissage_Tournoi(){

             $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('tournoi/findAll')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    
                    var html = '';
                    html += '<select class="btn mt-2 mb-2 btn-secondary bg-info  dropdown-toggle" name="nomTournoi" id="select-tournoi" >';
                    html += '<option disabled selected value="">Selectionner un tournoi (facultatif)</option >';
                    var i;
                    for(i=0 ; i < data.length ; i++) {
                        
                        html +='<option value="'+data[i].nomTournoi+ '">'+data[i].nomTournoi+'</option>';
                        
                    }      
                    html += '</select>';    
                    $('#select-tournoi').html(html);
                    }
                    
                    
                });
 
            }

var optionsprenom = {
  
  url: '<?php echo base_url('user/findFirstName')?>',

  getValue: "prenomUser",

  list: {	
    match: {
      enabled: true
    }
  },

};

var optionsnom = {
  
  url: '<?php echo base_url('user/findLastName') ?>',

  getValue: "nomUser",

  list: {	
    match: {
      enabled: true
    }
  },

};
$("#recherche-prenom-Gagnant").easyAutocomplete(optionsprenom);
$("#recherche-prenom-Perdant").easyAutocomplete(optionsprenom);

$("#recherche-nom-Gagnant").easyAutocomplete(optionsnom);
$("#recherche-nom-Perdant").easyAutocomplete(optionsnom);           
</script>
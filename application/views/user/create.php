

<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div> 
        <form method="post" accept-charset="utf-8" action="<?php base_url('user/create')?>">
            <div class="form-group">
                <label class="control-label">Numéro de licence</label>
                <input type="text" class="form-control" name="idUser"  value="" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Nom du joueur</label>
                <input type="text" class="form-control" name="nomUser"  value="" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Prénom du joueur</label>
                <input type="text" class="form-control" name="prenomUser"  value="" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Classement du joueur</label>
                <input type="numeric" class="form-control" name="classementUser"  value="" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Classement provisoire du joueur</label>
                <input type="numeric" class="form-control" name="classementProvisoireUser"  value="" size="30" required /> 
            </div>
            <div class="form-group">
             <label class="control-label" for="dateDeNaissance">date de naissance :</label>
             <input id="dateDeNaissance" class=" bg-light " name="dateDeNaissance" type="date" value="">
            </div>
             <div id="select-club">
                
     
            </div>
         

            <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

       </form>  
    </div>
</div>
<script>
     $(document).ready(function() {
         
        remplissage_Club();
         
         
     });
     function remplissage_Club(){

             $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('club/findAll')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    
                    var html = '<label for="select-club">Choisir un club :</label>';
                    html += '<select name="nomClub" id="select-club" required >';
                    html += '<option value="">--Selectionner un club--</option>';
                    var i;
                    for(i=0 ; i < data.length ; i++) {
                        
                        html +='<option value="'+data[i].nomClub+ '">'+data[i].nomClub+'</option>';
                        
                    }      
                    html += '</select>';    
                    $('#select-club').html(html);
                    }
                    
                    
                });
 
            }

     
    
</script>
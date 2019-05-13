<?php if ($isAdmin) { ?>

    <div class="container">
        <div class="row">
    <form class="border offset-4  mt-5 mb-5 text-center" method="post" accept-charset="utf-8" action="<?php base_url('administrateur/updateMail') ?>">
        <div class="form-group mr-5 ml-5 ">
            <label class=" control-label">mail</label>
            <input type="text" class="form-control" name="mail" value="<?php echo $administrateur[0]->mail ?>" size="30" required /> 
        </div>

        <div class=""><input class="btnSubmit" type="submit" value="modifier" /></div>
    </form>  
    
    <div class="offset-4 mb-3 ">
        <a class="btn btn-primary ml-5" href="<?php echo base_url('administrateur/updateMdp'); ?>" role="button">Modifier votre mot de passe</a>
    </div>
    </div>
    </div>
<?php } ?>

<?php if ($isAdmin) { ?>

    <div class="container">
        <div class="row">
            <div class=" m-auto  mt-5 mb-5 text-center" >
                <div class=" mr-5 ml-5 ">
                    <p> <?php echo "Votre adresse mail : " . $administrateur[0]->mail ?> </p>
                </div>
            </div> 
            <div class=" m-auto ">
                <a class="btn btn-primary ml-5" href="<?php echo base_url('administrateur/updateMdp'); ?>" role="button">Modifier votre mot de passe</a>
            </div>
        </div>
    </div>
<?php } ?>

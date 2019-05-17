<?php if ($isAdmin) { ?>
<main class="container">
        <div style=" margin-top: 20%">
            <div class="row mb-5">
                <p class=" m-auto"> <?php echo "Votre adresse mail : " . $administrateur[0]->mail ?> </p>
            </div> 
            <div class=" row mt-5">
                <a class="m-auto btn btn-primary" href="<?php echo base_url('administrateur/updateMdp'); ?>" role="button">Modifier votre mot de passe</a>
            </div>
        </div>
</main>
<?php } ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <head>
        <title>Classement Hérault tennis de table</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/footer.css"); ?>" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"/>
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url("assets/image/favipong.png"); ?>"/>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


        <script src="<?php echo base_url("assets/javascript/jquery.easy-autocomplete.min.js"); ?>"></script> 
        <link rel="stylesheet" href="<?php echo base_url("assets/css/easy-autocomplete.min.css"); ?>"/> 
    </head>               
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-dark ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php echo base_url(''); ?>" class="nav-link "> Accueil </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('user'); ?>"  class="nav-link " >Joueurs</a>
                    </li>
                    <?php if ($isAdmin) { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('rencontre'); ?>" class="nav-link " >Rencontres</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('tournoi'); ?>" class="nav-link " >Tournois</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('club'); ?>" class="nav-link " >Clubs</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('departement'); ?>" class="nav-link " >Départements</a>
                    </li>
                    <?php if ($isAdmin) { ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrateur'); ?>" class="nav-link" >Administrateur</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('rencontre/create'); ?>" class="nav-link" >Saisir une rencontre</a>
                        </li>
                    <?php } ?><?php if ($isAdmin) { ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrateur/profil'); ?>" class="nav-link" >Votre profil</a>
                        </li>
                    <?php } ?>


                    <?php if (!$isAdmin) { ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('welcome/connexion'); ?>" class="nav-link" >Connexion</a>
                        </li>
                    <?php } else { ?>

                        <li class="nav-item">
                            <a href="<?php echo base_url('administrateur/deconnexion'); ?>" class="nav-link" >Déconnexion</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <div id="contenu">

            <?php echo $output; ?>
        </div>
        <?php 
        if($footer == true){ ?>
        <footer class="page-footer font-small blue mt-5 mb-0">
            <div class="text-center ">
                <a> Nous contacter</a>
                <p> cdtt34@gmail.com </p>
            </div>
        </footer>
        <?php } ?>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    </body>

</html>


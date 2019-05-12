<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <head>
        <title>Classement Hérault tenis de table</title>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/site.css"); ?>" />
                <?php foreach ($css as $url): ?>
                    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
                <?php endforeach; ?>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></link>
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
              

                <script src="<?php echo base_url("assets/javascript/jquery.easy-autocomplete.min.js");?>"></script> 

                <link rel="stylesheet" href="<?php echo base_url("assets/css/easy-autocomplete.min.css"); ?>"> 
                <body>
                    <div>
                        <header class="navbar navbar-expand navbar-light flex-column navbar navbar-dark bg-dark bd-navbar">
                            <div class="navbar-nav-scroll">
                                <ul class="navbar-nav bd-navbar-nav flex-row">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(''); ?>" class="nav-link "> Accueil </a>
                                    </li>
                                    <li  class="nav-item">
                                        <a href="<?php echo base_url('user'); ?>"  class="nav-link " >Joueurs</a>
                                    </li>
                                    <li   class="nav-item">
                                        <a href="<?php echo base_url('tournoi'); ?>" class="nav-link " >Tournois</a>
                                    </li>
                                    <li   class="nav-item">
                                        <a href="<?php echo base_url('club'); ?>" class="nav-link " >Clubs</a>
                                    </li>
                                    <li   class="nav-item">
                                        <a href="<?php echo base_url('departement'); ?>" class="nav-link " >Departement</a>
                                    </li>
                                    <?php 
                                    
                                    if($isAdmin){?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('rencontre/create'); ?>" class="nav-link" >Saisir une rencontre</a>
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" >Contact</a>
                                    </li>
                                    
                                    
                                    <?php if($isAdmin){?>
                                    <li class="nav-item">
                                        <a class="nav-link" >Votre profil</a>
                                    </li>
                                     <?php } ?>
                                     <?php if(!$isAdmin){?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('admin/connexion'); ?>" class="nav-link" >Connexion</a>
                                    </li>
                                    <?php } else{?>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('welcome/deconnexion'); ?>" class="nav-link" >Déconnexion</a>
                                    </li>
                                     <?php } ?>
                                </ul>
                            </div>
                        </header>
                    </div>
                    <navbar>

                    </navbar>
                    <div id="contenu">

                        <?php echo $output; ?>
                    </div>
                    <footer class="page-footer  teal pt-4">


                        <div class="container-fluid text-center text-md-left">

                            <div class="row">


                                <div class="col-md-6 mt-md-0 mt-3">


                                    <h5 class="text-uppercase font-weight-bold">Footer text 1</h5>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita sapiente sint, nulla, nihil
                                        repudiandae commodi voluptatibus corrupti animi sequi aliquid magnam debitis, maxime quam recusandae
                                        harum esse fugiat. Itaque, culpa?</p>

                                </div>


                                <div class="col-md-6 mb-md-0 mb-3">


                                    <h5 class="text-uppercase font-weight-bold">Footer text 2</h5>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio deserunt fuga perferendis modi earum
                                        commodi aperiam temporibus quod nulla nesciunt aliquid debitis ullam omnis quos ipsam, aspernatur id
                                        excepturi hic.</p>

                                </div>


                            </div>


                        </div>


                    </footer>
                    <!-- Footer -->


                    <?php foreach ($js as $url): ?>
                        <script type="text/javascript" src="<?php echo $url; ?>"></script> 
                    <?php endforeach; ?>
                   
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
                </body>
    
                </html>


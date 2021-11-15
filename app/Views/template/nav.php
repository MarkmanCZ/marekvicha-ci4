<?php

    $uri = service('uri');

?>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="<?= base_url("/")?>" class="navbar-brand">WEB</a>
        <button class="navbar-toggler collapsed" data-toggle="collapse" data-target="#myMenu" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="navbar-collapse collapse" id="myMenu">
                <?php 
                    if(session()->has('user')){
                        if (session()->get('user')['group'] == 10){
                
                ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url("/")?>" class="nav-link font-weight-bold">domů</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("/progress")?>/" class="nav-link font-weight-bold">progress</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("/karty")?>" class="nav-link font-weight-bold">karty</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item nav-item pt-1 pt-sm-1 pt-md-2 pt-lg-0 pl-lg-1 <?= ($uri->getSegment(1) == 'profile' ? 'active' : null)?>">
                            <a href="<?= base_url("/dashboard")?>" class="btn btn-outline-primary  my-sm-0 text-light">Dashboard</a>
                        </li>
                        <li class="nav-item nav-item pt-1 pt-sm-1 pt-md-2 pt-lg-0 pl-lg-1 <?= ($uri->getSegment(1) == 'profile' ? 'active' : null)?>">
                            <a href="<?= base_url("/profile")?>" class="btn btn-outline-primary  my-sm-0 text-light">Profil</a>
                        </li>
                        <li class="nav-item nav-item pt-1 pt-sm-1 pt-md-2 pt-lg-0 pl-lg-1">
                            <a href="<?= base_url("/logout")?>" class="btn btn-outline-primary  my-sm-0 text-light">Odhlásit</a>
                        </li>
                    </ul>
                <?php }
                        elseif (session()->get('user')['isLoggedIn']){ 
                    ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url("/")?>" class="nav-link font-weight-bold">domů</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("/progress")?>/" class="nav-link font-weight-bold">progress</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("/karty")?>" class="nav-link font-weight-bold">karty</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item nav-item pt-1 pt-sm-1 pt-md-2 pt-lg-0 pl-lg-1 <?= ($uri->getSegment(1) == 'profile' ? 'active' : null)?>">
                            <a href="<?= base_url("/profile")?>" class="btn btn-outline-primary  my-sm-0 text-light">Profil</a>
                        </li>
                        <li class="nav-item nav-item pt-1 pt-sm-1 pt-md-2 pt-lg-0 pl-lg-1">
                            <a href="<?= base_url("/logout")?>" class="btn btn-outline-primary  my-sm-0 text-light">Odhlásit</a>
                        </li>
                    </ul>
                <?php 
                        }
                    }
                    else {                         
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= base_url("/")?>" class="nav-link font-weight-bold">domů</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url("/progress")?>/" class="nav-link font-weight-bold">progress</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url("/karty")?>" class="nav-link font-weight-bold">karty</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <form class="form-inline my-lg-0" action="<?= base_url("/")?>" method="POST">
                        <input class="form-control mr-sm-2 mb-2 mb-sm-0 mb-md-0 mb-xl-auto" type="email" name="email" placeholder="Email" >
                        <input class="form-control mr-sm-2 mb-2 mb-sm-0 mb-md-0 mb-xl-auto" type="password" name="password" placeholder="Heslo" >
                        <button class="btn btn-outline-primary my-sm-0 text-light" name="submit" type="submit">Přihlásit</button>
                    </form>
                    <li class="nav-item nav-item pt-1 pt-sm-1 pt-md-2 pt-lg-0 pl-lg-1">
                        <a href="<?= base_url("/register")?>" class="btn btn-outline-primary  my-sm-0 text-light">Registrace</a>
                    </li>
                </ul>
            <?php 
                }
            ?>
        </div>
    </div>
</nav>
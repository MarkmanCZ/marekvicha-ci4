<?= $this->extend('layout');?>

<?= $this->section('content')?>

<?php if(session()->get('succes')): ?>
<div class="container">
    <div class="alert alert-success alert-dismissible text-center mt-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?= session()->get('succes');?>
    </div>
</div>
<?php endif;?>
<?php if (isset($validation)): ?>
<div class="container">
    <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?= $validation->listErrors()?>
    </div>
</div>
<?php endif; ?>
<!-- Section without outside container -->
<section>
    <div class="jumbotron">
        <div class="container">
            <?php
                if( session()->get('name')) {
                    echo '<h1>Vítej ' . session()->get('name') .'</h1>';
                }
            ?>            
            <h2 class="display-4">Něco málo o mě</h2>
            <p class="lead">Ahoj já jsem Marek a mám rád programování webových aplikací</p>
            <hr class="my-4">
            <p class="lead">
                <a href="https://www.markman.cz/about.php" class="btn btn-primary btn-lg" type="button">Zjistit více</a>
            </p>
        </div>
    </div>
</section>

<main>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-12">
            <!-- Carousel -->
            <div id="showcaseCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#showcaseCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#showcaseCarousel" data-slide-to="1"></li>
                    <li data-target="#showcaseCarousel" data-slide-to="2"></li>
                    <li data-target="#showcaseCarousel" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="overlay-img" style="background-image: url(<?= base_url("images/setup/setup1.jpg")?>);"></div>
                        <div class="container con-carousel pl-3 pt-2">
                            <p class="text-light font-weight-bold">Můj setup</p>
                        </div>
                    </div>
                    <div class="carousel-item con-carousel">
                        <div class="overlay-img" style="background-image: url(<?= base_url("images/setup/setup2.jpg")?>);"></div>
                    </div>
                    <div class="carousel-item con-carousel">
                        <div class="overlay-img" style="background-image: url(<?= base_url("images/setup/setup3.jpg")?>);"></div>
                    </div>
                    <div class="carousel-item con-carousel">
                        <div class="overlay-img" style="background-image: url(<?= base_url("images/setup/setup4.jpg")?>);"></div>
                    </div>
                    <a href="#showcaseCarousel" class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a href="#showcaseCarousel" class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h2 class="p-3">Nějaké video z mé série o webech</h2>
            <iframe height="480px" class="embed-responsive custom-video" src="https://www.youtube.com/embed/Za-cRzkXYwk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

</div>

</main>

<?= $this->endSection();?>

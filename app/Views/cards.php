<?= $this->extend('layout');?>

<?= $this->section('content')?>
<main>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-xl-6 col-md-6">
                <?php 

                    if($data) {
                        foreach($data as $user) {
                    

                ?>
                <div class="card card-setup">
                    <img src="https://markman.cz/projekt/assets/images/person.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user->uName?></h5>
                        <h6 class="card-title"><?= $user->uEmail?></h6>
                        <p class="card-text"><?= $user->uText?></p>
                        <a href="#" class="btn btn-primary">Více</a>
                    </div>
                </div>
                <?php 
                        }
                    }

                ?>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection();?>

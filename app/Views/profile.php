<?= $this->extend('layout');?>

<?= $this->section('content')?>

<main>
	<div class="container">
    <?php if(session()->get('update')): ?>
    <div class="container">
        <div class="alert alert-success alert-dismissible text-center mt-1" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <?= session()->get('update');?>
        </div>
    </div>
    <?php endif;?>
            <div class="row pt-4">
                <div class="col-12">
                    <div class="img-thumbnail p-4">
                        <h2>Profil</h2>
                        <hr>
                        <form action="/profile" method="POST">
                            <div class="form-group">
                                <label for="name">Jméno a Příjmení</label>
                                <input type="text" class="form-control" name="name" value="<?= session()->get('user')['name'];?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" readonly name="email" value="<?= session()->get('user')['email'];?>">
                            </div>
                            <div class="form-group">
                                <label for="nickname">Uživatelské jméno</label>
                                <input type="text" class="form-control" name="nickname" value="<?= session()->get('user')['nick'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Popisek uživatele</label>
                                <textarea class="form-control" name="text" cols="30" rows="5" placeholder="<?= session()->get('user')['text'];?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="text">Heslo</label>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="passwordControl">Heslo kontrola</label>
                                <input class="form-control" type="password" name="passwordControl" id="passwordControl">
                            </div>
                            <input type="hidden" name="id" value="<?= session()->get('id');?>">
                            <button class="btn btn-success" type="submit" name="submit">Změnit</button>
                            <?php if (isset($validation)): ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <?php
                                       echo $validation->listErrors();
                                     ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

        </div>
</main>

<?= $this->endSection();?>
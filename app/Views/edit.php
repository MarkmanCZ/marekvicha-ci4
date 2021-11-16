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
            <div class="row pt-4 pb-2">
                <div class="col-12">
                    <div class="img-thumbnail p-4">
                        <h2>Editace uživatele</h2>
                        <hr>
                        <form action="/dashboard/edit" method="POST">
                            <div class="form-group">
                                <label for="uid">ID uživatele</label>
                                <input type="text" name="uid" readonly class="form-control" value="<?= $user['id'];?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Jméno a Příjmení</label>
                                <input type="text" class="form-control" name="name" value="<?= $user['uName'];?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" name="email" value="<?= $user['uEmail'];?>">
                            </div>
                            <div class="form-group">
                                <label for="nickname">Uživatelské jméno</label>
                                <input type="text" class="form-control" name="nickname" value="<?= $user['uNick'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Popisek uživatele</label>
                                <textarea class="form-control" name="text" cols="30" rows="5" placeholder="<?= $user['uText'];?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="group">Skupina</label>
                                <input type="text" name="group" class="form-control" value="<?= $user['uGroup']?>">
                            </div>
                            <input type="hidden" name="id" value="<?= session()->get('id');?>">
                            <button class="btn btn-success" type="submit" name="submit">Uložit</button>
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
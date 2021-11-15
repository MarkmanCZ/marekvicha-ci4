<?= $this->extend('layout');?>

<?= $this->section('content')?>
<!-- Main content -->
<main>
    <div class="container pt-5">
        <div class="img-thumbnail p-3 custom-form">
            <!-- Alert zpravy -->
            <form action="/register" method="POST">
                <h1>Registrovat</h1>
                <hr>
                <div class="form-group">
                    <label for="name">Jméno a Přímení</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?= set_value('name')?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?= set_value('email')?>">
                </div>
                <div class="form-group">
                    <label for="email">Přezdívka</label>
                    <input class="form-control" type="text" name="nickname" id="nickname" value="<?= set_value('nickname')?>">
                </div>
                <div class="form-group">
                    <label for="text">Heslo</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="passwordControl">Heslo kontrola</label>
                    <input class="form-control" type="password" name="passwordControl" id="passwordControl">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="checkBox" id="checkBox" value="consent">
                    <label class="form-check-label" for="checkBox ">Zaškrtni mě</label>
                </div>
                <button type="submit" name="submit" class="btn btn-success w-100">Zaregistrovat</button>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?= $validation->listErrors()?>
                    </div>
                <?php endif; ?>
            </form>
        </div>

    </div>
</main>

<?= $this->endSection();?>

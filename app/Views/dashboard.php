<?= $this->extend('layout');?>

<?= $this->section('content')?>
<main>
    <div class="container pt-4">
        <section>
            <?php if(session()->get('delete_error')): ?>
            <div class="container">
                <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <?= session()->get('delete_error');?>
                </div>
            </div>
            <?php endif;?>
        </section>
        <div class="card img-thumbnail">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Jméno</th>
                            <th>Email</th>
                            <th>Nickname</th>
                            <th>Registrovan</th>
                            <th>Skupina</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            if(isset($user_data)) {
                                foreach ($user_data as $user) {
                                echo '
                                    <tr>
                                        <td>'. $user->id.'</td>    
                                        <td>'. $user->uName.'</td>
                                        <td>'. $user->uEmail.'</td>                                
                                        <td>'. $user->uNick.'</td>
                                        <td>'. $user->registred_at.'</td>
                                        <td>'. $user->uGroup.'</td>
                                        <td><a href="'. base_url('/dashboard/'. $user->id).'"><button type="submit" name="edit" class="btn btn-primary">Edit</button></a></td>
                                        <td><a href="'. base_url('/dashboard/'. $user->id .'/delete') .'"><button type="submit" name="delete" class="btn btn-danger">Delete</button></a></td>
                                    </tr>
                                ';
                                }
                            }
                            
                        ?>
                    </table>                
                </div>
            </div>
        </div> 
    </div>
       
</main>

<?= $this->endSection();?>

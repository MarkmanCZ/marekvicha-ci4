<?= $this->extend('layout');?>

<?= $this->section('content')?>
<!-- Main content -->
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>První commit</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Základ projektu.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Hlavička a patička</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Co víc napsat? :)</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Updaty</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Úprava readme.md a .gitignore, přidán container a navbar.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Úprava navbaru</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Úprava navbaru.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Přechod z html na PHP</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Přešel jsem na PHP k vůli možnosti Login/Register a dalších funcí, i pro přehlednost.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>3x update vlastního js a accordionu</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Vymýšlel jsem vlastni js kód pro accordion a jeho stylizování.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Úprava accordionu a přidány karty</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Přidány karty, nakonci využto SQL SELECT, zobrazuje uživatele, kteří se zaregistrovali.</p>
                            <p>Nějaké základní údaje, v budoucnu, při použití CodeIgniteru, bych zde mohl použít funčnost, že by si uživatel mohl volit, co chce nechat veřejně dostupné.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Styly, fotky, iframe video</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>Přidal jsem caroussel, upravil fotky a nějaká stylizace.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item-header">
                        <h3>Login/Register</h3>
                    </div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                            <p>V září 30. až po říjen 3. jsem dělal Login/Register systém.</p>
                            <p>Ne samosřejmě v kuse, hotovo jsem měl již dříve, ale dolaďoval jsem error handlery a další drobnosti, na co nejlepší funkci.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?= $this->endSection();?>

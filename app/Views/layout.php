<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Opakovaci WEB</title>
    <?= $this->include("/template/head")?>

</head>
<body>

<?= $this->include("/template/nav")?>

<?php $this->renderSection('content');?>

<?= $this->include("/template/footer")?>

</body>
</html>
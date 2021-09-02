<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL']?>app/assets/css/template.css">
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL']?>app/assets/css/<?=$css?>">
    <script src="<?=$_ENV['BASE_URL']?>app/assets/js/jquery.js"></script>
    <script src="<?=$_ENV['BASE_URL']?>app/assets/js/template.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="<?=$_ENV['BASE_URL']?>/app/assets/libraries/bootstrap.css" rel="stylesheet">
    <script src="<?=$_ENV['BASE_URL']?>app/assets/libraries/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="icon" href="<?=$_ENV['BASE_URL']?>app/assets/favicon/favicon.ico" sizes="16x16" type="image/png"> -->
</head>
<body>
    <h3>menu</h6>
    <hr>
    <?php $this->loadViewInTemplate($viewName, $viewData)?>
    <hr>
    <h3>footer</h6>
</body>
</html>
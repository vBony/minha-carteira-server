<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <script src="<?=$base_url?>app/assets/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="<?=$base_url?>/app/assets/libraries/bootstrap.css" rel="stylesheet">
    <script src="<?=$base_url?>app/assets/libraries/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?=$base_url?>app/assets/css/template.css">
    <script src="<?=$base_url?>app/assets/js/template.js"></script>
    <script src="<?=$base_url?>app/assets/libraries/jquery.mask.min.js"></script>
    <script src="<?=$base_url?>app/assets/js/<?=$js?>"></script>
    <link rel="stylesheet" href="<?=$base_url?>app/assets/css/<?=$css?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $base_url ?>">
                <div class="fs-4 bg-success text-white px-2 py-1 rounded-circle"> <i class="fas fa-money-bill-wave-alt text-white"></i></div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $base_url ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item ml-auto">
                        <div class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$user_data['usu_nome']?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Configurações</a></li>
                                <li><a class="dropdown-item" href="#">Sair</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-3">
        <?php $this->loadViewInTemplate($viewName, $viewData)?>
    </div>
    <hr>
    <h3>footer</h6>
</body>
</html>
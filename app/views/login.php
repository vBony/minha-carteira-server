<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$base_url . 'app/assets/css/login.css' ?>">
    <script src="<?=$base_url . 'app/assets/js/jquery.js' ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="<?=$base_url . 'app/assets/libraries/bootstrap.css' ?>" rel="stylesheet">
    <script src="<?=$base_url . 'app/assets/libraries/bootstrap.js' ?>"></script>
    <script src="<?=$base_url . 'app/assets/js/login.js' ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login - minha carteira</title>
</head>
<body>
    <div class="container-fluid h-100 d-flex align-items-center justify-content-center app" style="background-color:#F0F4FF">
        <div class="login-box card p-3">
            <div class="row">
                <div class="d-flex direction-row align-center mb-4">
                    <div class="fs-4 bg-success text-white px-4 rounded-pill"> <i class="fas fa-money-bill-wave-alt text-white"></i> minha carteira</div>
                </div>
            </div>

            <div class="row mb-3">
                <h3>Login</h3>
            </div>
            <form class="needs-validation" id="form-login" novalidate>
                <div class="row g-2">
                    <div class="form-floating mb-3 col-lg-12">
                        <input type="email" class="form-control" id="email" name="usu_email" placeholder="E-mail" required>
                        <label for="floatingInput">E-mail</label>
                        <div class="invalid-feedback" id="msg_usu_email"></div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="form-floating mb-2 col-lg-12">
                        <input type="password" class="form-control" id="senha" name="usu_senha" placeholder="Senha" required>
                        <label for="floatingInput">Senha</label>
                        <div class="invalid-feedback" id="msg_usu_senha"></div>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <input type="submit" class="btn btn-success btn-lg" value="Entrar">
                </div>

                <div class="row g-2 mt-4">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="<?=$base_url . 'criar-conta'?>" class="text-success">Não possuo uma conta</a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 text-end">
                        <a href="<?=$base_url . 'esqueci-senha'?>" class="text-success ">Esqueci minha senha</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <input type="hidden" name="base_url" value="<?=$base_url?>">
</body>
</html>
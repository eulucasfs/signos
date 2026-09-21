<?php
/**
 * index.php
 * Página inicial do projeto "Descubra seu Signo".
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Descubra seu Signo</title>

<!-- Bootstrap 5 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
<!-- CSS próprio -->
<link href="css/style.css" rel="stylesheet">
</head>
<body>

<!-- Fundo de estrelas -->
<div class="stars" id="stars"></div>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">

            <div class="text-center mb-4">
                <div class="zodiac-wheel mb-3">
                    <i class="fa-solid fa-star zodiac-icon icon-1"></i>
                    <i class="fa-solid fa-moon zodiac-icon icon-2"></i>
                    <i class="fa-solid fa-sun zodiac-icon icon-3"></i>
                    <i class="fa-solid fa-meteor zodiac-icon icon-4"></i>
                </div>
                <h1 class="titulo-principal">
                    <i class="fa-solid fa-sparkles me-2"></i>Descubra seu Signo
                </h1>
                <p class="subtitulo">
                    Informe sua data de nascimento e desvende os segredos que os astros reservaram para você.
                </p>
            </div>

            <div class="card card-formulario shadow-lg">
                <div class="card-body p-4 p-md-5">

                    <form id="formSigno" action="resultado.php" method="POST" novalidate>
                        <div class="mb-4">
                            <label for="data_nascimento" class="form-label">
                                <i class="fa-solid fa-calendar-days me-2"></i>Data de nascimento
                            </label>
                            <input
                                type="date"
                                class="form-control form-control-lg"
                                id="data_nascimento"
                                name="data_nascimento"
                                required
                                max=""
                            >
                            <div class="invalid-feedback" id="erroData">
                                Por favor, informe uma data de nascimento válida.
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-descobrir btn-lg">
                                <i class="fa-solid fa-wand-magic-sparkles me-2"></i>Descobrir meu signo
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="text-center mt-4 signos-rodape">
                <span title="Áries">♈</span>
                <span title="Touro">♉</span>
                <span title="Gêmeos">♊</span>
                <span title="Câncer">♋</span>
                <span title="Leão">♌</span>
                <span title="Virgem">♍</span>
                <span title="Libra">♎</span>
                <span title="Escorpião">♏</span>
                <span title="Sagitário">♐</span>
                <span title="Capricórnio">♑</span>
                <span title="Aquário">♒</span>
                <span title="Peixes">♓</span>
            </div>

            <p class="text-center creditos mt-3">
                Projeto "Descubra seu Signo" &mdash; PHP + Bootstrap 5
            </p>

        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<!-- JS próprio -->
<script src="js/script.js"></script>
</body>
</html>

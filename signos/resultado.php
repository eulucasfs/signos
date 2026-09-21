<?php
/**
 * resultado.php
 * Recebe a data de nascimento via POST, calcula o signo e exibe o resultado.
 */

require_once __DIR__ . '/includes/signos.php';

$erro = null;
$dados = null;
$dataFormatada = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['data_nascimento'])) {

    $dataRecebida = trim($_POST['data_nascimento']);

    // Espera-se o formato AAAA-MM-DD (padrão do <input type="date">)
    $partes = DateTime::createFromFormat('Y-m-d', $dataRecebida);
    $erros = DateTime::getLastErrors();

    if ($partes instanceof DateTime && (!$erros || ($erros['warning_count'] === 0 && $erros['error_count'] === 0))) {
        $hoje = new DateTime();

        if ($partes > $hoje) {
            $erro = 'A data informada está no futuro. Por favor, informe uma data de nascimento válida.';
        } else {
            $dia = (int) $partes->format('d');
            $mes = (int) $partes->format('m');

            $chaveSigno = calcularSigno($dia, $mes);
            $dados = obterDadosSigno($chaveSigno);
            $dataFormatada = $partes->format('d/m/Y');
        }
    } else {
        $erro = 'Data inválida. Por favor, volte e selecione uma data de nascimento correta.';
    }
} else {
    $erro = 'Nenhuma data foi informada. Por favor, volte ao início e preencha o formulário.';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $dados ? 'Seu signo é ' . htmlspecialchars($dados['nome']) : 'Resultado'; ?> — Descubra seu Signo</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<?php if ($dados): ?>
<style>
    :root {
        --cor-signo: <?= htmlspecialchars($dados['cor']); ?>;
    }
</style>
<?php endif; ?>
</head>
<body>

<div class="stars" id="stars"></div>

<div class="container py-5">

    <?php if ($erro): ?>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="alert alert-danger text-center shadow-lg mt-5" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-2x mb-3"></i>
                    <p class="mb-3"><?= htmlspecialchars($erro); ?></p>
                    <a href="index.php" class="btn btn-descobrir">
                        <i class="fa-solid fa-arrow-left me-2"></i>Voltar ao início
                    </a>
                </div>
            </div>
        </div>

    <?php elseif ($dados): ?>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">

                <div class="text-center mb-4">
                    <p class="subtitulo-resultado">
                        <i class="fa-solid fa-calendar-check me-2"></i>
                        Nascimento em <?= htmlspecialchars($dataFormatada); ?>
                    </p>
                    <div class="simbolo-signo"><?= $dados['simbolo']; ?></div>
                    <h1 class="titulo-signo"><?= htmlspecialchars($dados['nome']); ?></h1>
                    <p class="periodo-signo"><?= htmlspecialchars($dados['periodo']); ?></p>
                </div>

                <!-- Cartões de atributos -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card card-atributo text-center h-100">
                            <div class="card-body">
                                <i class="fa-solid fa-fire-flame-curved fa-lg mb-2"></i>
                                <div class="atributo-label">Elemento</div>
                                <div class="atributo-valor"><?= htmlspecialchars($dados['elemento']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card card-atributo text-center h-100">
                            <div class="card-body">
                                <i class="fa-solid fa-arrows-spin fa-lg mb-2"></i>
                                <div class="atributo-label">Modalidade</div>
                                <div class="atributo-valor"><?= htmlspecialchars($dados['modalidade']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card card-atributo text-center h-100">
                            <div class="card-body">
                                <i class="fa-solid fa-globe fa-lg mb-2"></i>
                                <div class="atributo-label">Planeta regente</div>
                                <div class="atributo-valor"><?= htmlspecialchars($dados['planeta']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card card-atributo text-center h-100">
                            <div class="card-body">
                                <i class="fa-solid <?= htmlspecialchars($dados['icone']); ?> fa-lg mb-2"></i>
                                <div class="atributo-label">Símbolo</div>
                                <div class="atributo-valor fs-3"><?= $dados['simbolo']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="card card-conteudo mb-4">
                    <div class="card-body p-4">
                        <h2 class="h5 titulo-secao"><i class="fa-solid fa-book-open me-2"></i>Sobre o signo</h2>
                        <p class="mb-0"><?= htmlspecialchars($dados['descricao']); ?></p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <!-- Características -->
                    <div class="col-12 col-md-6">
                        <div class="card card-conteudo h-100">
                            <div class="card-body p-4">
                                <h2 class="h5 titulo-secao"><i class="fa-solid fa-list-check me-2"></i>Características</h2>
                                <ul class="lista-caracteristicas mb-0">
                                    <?php foreach ($dados['caracteristicas'] as $item): ?>
                                        <li><i class="fa-solid fa-star me-2"></i><?= htmlspecialchars($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem -->
                    <div class="col-12 col-md-6">
                        <div class="card card-conteudo card-mensagem h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                                <i class="fa-solid fa-quote-left fa-2x mb-3"></i>
                                <p class="fst-italic mb-0"><?= htmlspecialchars($dados['mensagem']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <!-- Pontos positivos -->
                    <div class="col-12 col-md-6">
                        <div class="card card-conteudo h-100 card-positivos">
                            <div class="card-body p-4">
                                <h2 class="h5 titulo-secao"><i class="fa-solid fa-circle-check me-2"></i>Pontos positivos</h2>
                                <ul class="lista-pontos mb-0">
                                    <?php foreach ($dados['pontos_positivos'] as $item): ?>
                                        <li><i class="fa-solid fa-check me-2"></i><?= htmlspecialchars($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Pontos de atenção -->
                    <div class="col-12 col-md-6">
                        <div class="card card-conteudo h-100 card-atencao">
                            <div class="card-body p-4">
                                <h2 class="h5 titulo-secao"><i class="fa-solid fa-circle-exclamation me-2"></i>Pontos de atenção</h2>
                                <ul class="lista-pontos mb-0">
                                    <?php foreach ($dados['pontos_atencao'] as $item): ?>
                                        <li><i class="fa-solid fa-minus me-2"></i><?= htmlspecialchars($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <a href="index.php" class="btn btn-descobrir btn-lg">
                        <i class="fa-solid fa-arrow-rotate-left me-2"></i>Consultar outra data
                    </a>
                </div>

            </div>
        </div>

    <?php endif; ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>

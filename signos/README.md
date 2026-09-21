# 🔮 Descubra seu Signo

Projeto web completo, desenvolvido em **PHP, HTML5, CSS3, JavaScript e Bootstrap 5**, que descobre automaticamente o signo do zodíaco de um usuário a partir da sua data de nascimento.

## 📁 Estrutura do projeto

```
/signos
│
├── index.php              # Página inicial com o formulário
├── resultado.php          # Página de resultado com os dados do signo
├── css/
│   └── style.css          # Estilos (tema estrelado / zodíaco)
├── js/
│   └── script.js          # Validação do formulário no navegador
├── includes/
│   └── signos.php         # Lógica de cálculo do signo + base de dados
└── README.md
```

## ⚙️ Tecnologias utilizadas

- **PHP** (puro, sem frameworks) — cálculo do signo e renderização do resultado
- **HTML5**
- **CSS3** (variáveis CSS, gradientes, animações, responsividade)
- **JavaScript** (validação de formulário no cliente)
- **Bootstrap 5** (via CDN) — grid, componentes e responsividade
- **Font Awesome 6** (via CDN) — ícones

## ▶️ Como executar

O projeto precisa de um servidor com PHP (7.4+ recomendado). Duas formas simples:

### Opção 1 — Servidor embutido do PHP

Dentro da pasta `signos`, execute:

```bash
php -S localhost:8000
```

Depois acesse **http://localhost:8000** no navegador.

### Opção 2 — XAMPP / WAMP / MAMP

1. Copie a pasta `signos` para o diretório `htdocs` (XAMPP/MAMP) ou `www` (WAMP).
2. Inicie o Apache.
3. Acesse **http://localhost/signos**.

## 🧠 Como funciona o cálculo do signo

O arquivo `includes/signos.php` contém:

1. **`calcularSigno($dia, $mes)`** — recebe o dia e o mês de nascimento e retorna a chave do signo correspondente, comparando com os períodos oficiais de cada signo do zodíaco.
2. **`obterDadosSigno($chave)`** — retorna um array associativo com todas as informações do signo: nome, símbolo, período, elemento, modalidade, planeta regente, descrição, características, pontos positivos, pontos de atenção e uma mensagem especial.

O arquivo `resultado.php`:

- Recebe a data via `$_POST['data_nascimento']` (enviada pelo formulário em `index.php`, método POST);
- Valida a data recebida (formato, existência e se não está no futuro) usando a classe `DateTime` do PHP;
- Em caso de erro, exibe uma mensagem amigável e um botão para voltar ao início;
- Em caso de sucesso, calcula o signo e monta a página de resultado com todos os detalhes.

## ✅ Validações implementadas

- **No cliente (JavaScript):** impede o envio do formulário caso nenhuma data seja selecionada, ou caso a data seja futura, exibindo uma mensagem de erro visual (Bootstrap `invalid-feedback`).
- **No servidor (PHP):** revalida a data recebida via `DateTime::createFromFormat`, verificando se é uma data real e se não é uma data futura — importante porque a validação do navegador pode ser burlada.

## 🎨 Identidade visual

- Fundo com gradiente escuro e efeito de **estrelas cintilantes** (CSS puro, sem imagens externas).
- Ícones flutuantes (sol, lua, estrela, meteoro) no topo da página inicial.
- Símbolos dos 12 signos no rodapé da página inicial.
- Cada signo, na página de resultado, ganha uma **cor de destaque própria** (definida via variável CSS `--cor-signo`), aplicada ao símbolo, período e ícones dos cartões.
- Layout totalmente responsivo, construído com o sistema de grid do Bootstrap 5 (`container`, `row`, `col-*`).

## 📄 Licença

Projeto livre para fins de estudo e aprendizado.

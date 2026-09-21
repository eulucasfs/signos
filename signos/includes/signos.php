<?php
/**
 * includes/signos.php
 *
 * Contém a lógica de cálculo do signo a partir de uma data de nascimento
 * e a base de dados com as informações completas de cada signo.
 */

/**
 * Calcula o signo zodiacal a partir do dia e mês informados.
 *
 * @param int $dia Dia de nascimento (1-31)
 * @param int $mes Mês de nascimento (1-12)
 * @return string Chave do signo (ex: "aries", "touro", ...)
 */
function calcularSigno(int $dia, int $mes): string
{
    // Cada item representa o ÚLTIMO dia em que o signo correspondente é válido,
    // permitindo comparar (mes, dia) contra os limites de cada período.
    $periodos = [
        ['signo' => 'capricornio', 'fim_mes' => 1,  'fim_dia' => 19],
        ['signo' => 'aquario',     'fim_mes' => 2,  'fim_dia' => 18],
        ['signo' => 'peixes',      'fim_mes' => 3,  'fim_dia' => 20],
        ['signo' => 'aries',       'fim_mes' => 4,  'fim_dia' => 19],
        ['signo' => 'touro',       'fim_mes' => 5,  'fim_dia' => 20],
        ['signo' => 'gemeos',      'fim_mes' => 6,  'fim_dia' => 20],
        ['signo' => 'cancer',      'fim_mes' => 7,  'fim_dia' => 22],
        ['signo' => 'leao',        'fim_mes' => 8,  'fim_dia' => 22],
        ['signo' => 'virgem',      'fim_mes' => 9,  'fim_dia' => 22],
        ['signo' => 'libra',       'fim_mes' => 10, 'fim_dia' => 22],
        ['signo' => 'escorpiao',   'fim_mes' => 11, 'fim_dia' => 21],
        ['signo' => 'sagitario',   'fim_mes' => 12, 'fim_dia' => 21],
        ['signo' => 'capricornio', 'fim_mes' => 12, 'fim_dia' => 31],
    ];

    foreach ($periodos as $periodo) {
        if ($mes < $periodo['fim_mes'] || ($mes === $periodo['fim_mes'] && $dia <= $periodo['fim_dia'])) {
            return $periodo['signo'];
        }
    }

    // Segurança (nunca deve chegar aqui com mes 1-12 válido)
    return 'capricornio';
}

/**
 * Retorna todas as informações detalhadas de um signo.
 *
 * @param string $chave Chave do signo (ex: "aries")
 * @return array|null Dados do signo ou null se não encontrado
 */
function obterDadosSigno(string $chave): ?array
{
    $signos = [
        'aries' => [
            'nome' => 'Áries',
            'simbolo' => '♈',
            'periodo' => '21/03 a 19/04',
            'elemento' => 'Fogo',
            'modalidade' => 'Cardinal',
            'planeta' => 'Marte',
            'cor' => '#ff4d4d',
            'icone' => 'fa-fire',
            'descricao' => 'Áries é o primeiro signo do zodíaco, marcado pela energia, coragem e espírito pioneiro. Os arianos gostam de estar à frente, iniciando projetos e enfrentando desafios de cabeça erguida.',
            'caracteristicas' => ['Corajoso e determinado', 'Impulsivo e cheio de energia', 'Líder nato', 'Competitivo', 'Sincero ao expressar opiniões'],
            'pontos_positivos' => ['Iniciativa e liderança', 'Coragem para enfrentar desafios', 'Entusiasmo contagiante', 'Honestidade nas relações'],
            'pontos_atencao' => ['Impaciência excessiva', 'Impulsividade nas decisões', 'Dificuldade em ouvir opiniões contrárias', 'Tendência a agir sem pensar nas consequências'],
            'mensagem' => 'Sua energia é capaz de mover montanhas — use-a com sabedoria e conquiste tudo o que desejar.',
        ],
        'touro' => [
            'nome' => 'Touro',
            'simbolo' => '♉',
            'periodo' => '20/04 a 20/05',
            'elemento' => 'Terra',
            'modalidade' => 'Fixo',
            'planeta' => 'Vênus',
            'cor' => '#8bc34a',
            'icone' => 'fa-leaf',
            'descricao' => 'Touro é um signo de terra que valoriza estabilidade, conforto e prazeres da vida. Os taurinos são pacientes, determinados e buscam construir uma base sólida em tudo o que fazem.',
            'caracteristicas' => ['Persistente e determinado', 'Apreciador do conforto e da boa vida', 'Leal nos relacionamentos', 'Prático e realista', 'Teimoso quando contrariado'],
            'pontos_positivos' => ['Confiabilidade e lealdade', 'Paciência para atingir objetivos', 'Senso prático', 'Estabilidade emocional'],
            'pontos_atencao' => ['Teimosia excessiva', 'Resistência a mudanças', 'Apego material', 'Dificuldade em sair da zona de conforto'],
            'mensagem' => 'A paciência é sua maior força: continue construindo, passo a passo, a vida sólida que você merece.',
        ],
        'gemeos' => [
            'nome' => 'Gêmeos',
            'simbolo' => '♊',
            'periodo' => '21/05 a 20/06',
            'elemento' => 'Ar',
            'modalidade' => 'Mutável',
            'planeta' => 'Mercúrio',
            'cor' => '#ffd54f',
            'icone' => 'fa-comments',
            'descricao' => 'Gêmeos é o signo da comunicação e da versatilidade. Curiosos por natureza, os geminianos adoram aprender, conversar e se adaptar a diferentes situações e pessoas.',
            'caracteristicas' => ['Comunicativo e articulado', 'Curioso e versátil', 'Sociável', 'Inteligente e rápido de raciocínio', 'Inquieto'],
            'pontos_positivos' => ['Facilidade de comunicação', 'Adaptabilidade', 'Criatividade', 'Senso de humor'],
            'pontos_atencao' => ['Inconstância', 'Dificuldade em manter o foco', 'Superficialidade em alguns vínculos', 'Ansiedade mental'],
            'mensagem' => 'Sua mente curiosa é um dom — canalize essa energia para aprofundar o que realmente importa.',
        ],
        'cancer' => [
            'nome' => 'Câncer',
            'simbolo' => '♋',
            'periodo' => '21/06 a 22/07',
            'elemento' => 'Água',
            'modalidade' => 'Cardinal',
            'planeta' => 'Lua',
            'cor' => '#90caf9',
            'icone' => 'fa-water',
            'descricao' => 'Câncer é o signo da sensibilidade e do cuidado. Governados pela Lua, os cancerianos são profundamente emotivos, protetores e valorizam muito o lar e a família.',
            'caracteristicas' => ['Sensível e emotivo', 'Protetor com quem ama', 'Intuitivo', 'Apegado às memórias e à família', 'Reservado com desconhecidos'],
            'pontos_positivos' => ['Empatia e acolhimento', 'Lealdade afetiva', 'Intuição forte', 'Cuidado com quem ama'],
            'pontos_atencao' => ['Oscilações de humor', 'Apego excessivo ao passado', 'Dificuldade em lidar com críticas', 'Tendência a se fechar emocionalmente'],
            'mensagem' => 'Sua sensibilidade é uma força, não uma fraqueza — use-a para cuidar de si tanto quanto cuida dos outros.',
        ],
        'leao' => [
            'nome' => 'Leão',
            'simbolo' => '♌',
            'periodo' => '23/07 a 22/08',
            'elemento' => 'Fogo',
            'modalidade' => 'Fixo',
            'planeta' => 'Sol',
            'cor' => '#ffb300',
            'icone' => 'fa-crown',
            'descricao' => 'Leão é o signo da autoconfiança e do brilho pessoal. Governados pelo Sol, os leoninos gostam de ser reconhecidos, têm grande generosidade e um forte senso de dignidade.',
            'caracteristicas' => ['Confiante e carismático', 'Generoso', 'Criativo', 'Gosta de reconhecimento', 'Orgulhoso'],
            'pontos_positivos' => ['Liderança natural', 'Generosidade', 'Otimismo', 'Lealdade aos amigos'],
            'pontos_atencao' => ['Vaidade excessiva', 'Dificuldade em aceitar críticas', 'Necessidade constante de atenção', 'Autoritarismo'],
            'mensagem' => 'Brilhe com autenticidade — sua luz inspira, mas o verdadeiro poder está em iluminar também os outros.',
        ],
        'virgem' => [
            'nome' => 'Virgem',
            'simbolo' => '♍',
            'periodo' => '23/08 a 22/09',
            'elemento' => 'Terra',
            'modalidade' => 'Mutável',
            'planeta' => 'Mercúrio',
            'cor' => '#a1887f',
            'icone' => 'fa-seedling',
            'descricao' => 'Virgem é o signo da análise e do cuidado com os detalhes. Práticos e organizados, os virginianos buscam a perfeição e são extremamente dedicados ao trabalho e às pessoas que amam.',
            'caracteristicas' => ['Organizado e detalhista', 'Analítico', 'Prestativo', 'Perfeccionista', 'Crítico consigo mesmo'],
            'pontos_positivos' => ['Senso de responsabilidade', 'Capacidade analítica', 'Dedicação ao trabalho', 'Confiabilidade'],
            'pontos_atencao' => ['Perfeccionismo excessivo', 'Autocrítica exagerada', 'Preocupação constante', 'Dificuldade em relaxar'],
            'mensagem' => 'A busca pela perfeição é bonita, mas lembre-se: você já é suficiente exatamente como é.',
        ],
        'libra' => [
            'nome' => 'Libra',
            'simbolo' => '♎',
            'periodo' => '23/09 a 22/10',
            'elemento' => 'Ar',
            'modalidade' => 'Cardinal',
            'planeta' => 'Vênus',
            'cor' => '#ce93d8',
            'icone' => 'fa-balance-scale',
            'descricao' => 'Libra é o signo do equilíbrio e da harmonia. Diplomáticos e sociáveis, os librianos buscam justiça nas relações e têm grande apreço pela estética e pela beleza.',
            'caracteristicas' => ['Diplomático e conciliador', 'Sociável', 'Apreciador da beleza e da arte', 'Justo', 'Indeciso'],
            'pontos_positivos' => ['Senso de justiça', 'Facilidade de se relacionar', 'Diplomacia', 'Bom gosto estético'],
            'pontos_atencao' => ['Indecisão frequente', 'Medo de conflitos', 'Dependência da aprovação dos outros', 'Dificuldade em dizer não'],
            'mensagem' => 'O equilíbrio que você busca fora também precisa florescer dentro de você — confie mais nas suas próprias escolhas.',
        ],
        'escorpiao' => [
            'nome' => 'Escorpião',
            'simbolo' => '♏',
            'periodo' => '23/10 a 21/11',
            'elemento' => 'Água',
            'modalidade' => 'Fixo',
            'planeta' => 'Plutão',
            'cor' => '#7b1fa2',
            'icone' => 'fa-magic',
            'descricao' => 'Escorpião é o signo da intensidade e da profundidade emocional. Misteriosos e determinados, os escorpianos possuem grande força de vontade e uma percepção aguçada sobre as pessoas.',
            'caracteristicas' => ['Intenso e apaixonado', 'Determinado', 'Perspicaz', 'Leal', 'Reservado'],
            'pontos_positivos' => ['Força de vontade', 'Lealdade profunda', 'Capacidade de superação', 'Intuição poderosa'],
            'pontos_atencao' => ['Ciúme e possessividade', 'Dificuldade em perdoar', 'Desconfiança excessiva', 'Intensidade emocional que pode assustar'],
            'mensagem' => 'Sua profundidade é rara — permita que as pessoas certas cheguem perto o suficiente para conhecê-la.',
        ],
        'sagitario' => [
            'nome' => 'Sagitário',
            'simbolo' => '♐',
            'periodo' => '22/11 a 21/12',
            'elemento' => 'Fogo',
            'modalidade' => 'Mutável',
            'planeta' => 'Júpiter',
            'cor' => '#ff7043',
            'icone' => 'fa-compass',
            'descricao' => 'Sagitário é o signo da liberdade e da aventura. Otimistas e filosóficos, os sagitarianos amam explorar novos horizontes, sejam eles físicos ou intelectuais.',
            'caracteristicas' => ['Aventureiro e otimista', 'Filosófico', 'Independente', 'Sincero, às vezes bruto', 'Inquieto'],
            'pontos_positivos' => ['Otimismo contagiante', 'Espírito aventureiro', 'Sinceridade', 'Visão ampla de mundo'],
            'pontos_atencao' => ['Falta de paciência com rotina', 'Impulsividade', 'Dificuldade em se comprometer', 'Falta de tato ao falar'],
            'mensagem' => 'O mundo é grande demais para você ficar parado — continue explorando, mas não se esqueça de criar raízes.',
        ],
        'capricornio' => [
            'nome' => 'Capricórnio',
            'simbolo' => '♑',
            'periodo' => '22/12 a 19/01',
            'elemento' => 'Terra',
            'modalidade' => 'Cardinal',
            'planeta' => 'Saturno',
            'cor' => '#607d8b',
            'icone' => 'fa-mountain',
            'descricao' => 'Capricórnio é o signo da ambição e da disciplina. Determinados e responsáveis, os capricornianos trabalham incansavelmente para alcançar seus objetivos de longo prazo.',
            'caracteristicas' => ['Disciplinado e responsável', 'Ambicioso', 'Paciente', 'Prático', 'Reservado emocionalmente'],
            'pontos_positivos' => ['Determinação', 'Senso de responsabilidade', 'Persistência', 'Capacidade organizacional'],
            'pontos_atencao' => ['Rigidez excessiva', 'Dificuldade em relaxar e se divertir', 'Pessimismo em momentos de pressão', 'Tendência ao isolamento'],
            'mensagem' => 'O sucesso que você constrói com tanto esforço merece ser celebrado — permita-se também descansar.',
        ],
        'aquario' => [
            'nome' => 'Aquário',
            'simbolo' => '♒',
            'periodo' => '20/01 a 18/02',
            'elemento' => 'Ar',
            'modalidade' => 'Fixo',
            'planeta' => 'Urano',
            'cor' => '#4fc3f7',
            'icone' => 'fa-bolt',
            'descricao' => 'Aquário é o signo da originalidade e do inconformismo. Visionários e independentes, os aquarianos valorizam a liberdade de pensamento e buscam causas coletivas e humanitárias.',
            'caracteristicas' => ['Original e criativo', 'Independente', 'Idealista', 'Humanitário', 'Imprevisível'],
            'pontos_positivos' => ['Visão inovadora', 'Senso de justiça social', 'Originalidade', 'Mente aberta'],
            'pontos_atencao' => ['Distanciamento emocional', 'Teimosia em ideias fixas', 'Dificuldade em seguir regras', 'Imprevisibilidade nas relações'],
            'mensagem' => 'Suas ideias podem mudar o mundo — mas não se esqueça de estar presente também nas pequenas conexões do dia a dia.',
        ],
        'peixes' => [
            'nome' => 'Peixes',
            'simbolo' => '♓',
            'periodo' => '19/02 a 20/03',
            'elemento' => 'Água',
            'modalidade' => 'Mutável',
            'planeta' => 'Neptuno',
            'cor' => '#4dd0e1',
            'icone' => 'fa-fish',
            'descricao' => 'Peixes é o signo da sensibilidade e da imaginação. Últimos do zodíaco, os piscianos carregam grande empatia, intuição e uma conexão profunda com o mundo emocional e espiritual.',
            'caracteristicas' => ['Sensível e empático', 'Imaginativo', 'Intuitivo', 'Compassivo', 'Sonhador'],
            'pontos_positivos' => ['Empatia profunda', 'Criatividade artística', 'Capacidade de se adaptar emocionalmente', 'Generosidade'],
            'pontos_atencao' => ['Fuga da realidade', 'Dificuldade em estabelecer limites', 'Instabilidade emocional', 'Facilidade em se sacrificar demais pelos outros'],
            'mensagem' => 'Sua sensibilidade é um oceano de possibilidades — aprenda também a nadar com os pés firmes na realidade.',
        ],
    ];

    return $signos[$chave] ?? null;
}

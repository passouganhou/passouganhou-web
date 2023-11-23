<?php

namespace App\Http\Livewire\ContactForms;

use App\Services\v2\CrmService;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Dynamic extends Component
{
    public $mccList, $invoicingList, $statesList;
    public $captcha = null;
    public string $name = '', $telephone = '', $email = '', $state = '', $businessMcc = '', $invoicing = '';
    public bool $sucess = false;

    private string $rulerID = '24DBC531-4E83-4498-BDF8-F3224F72B24E';
    public string $siteKey = '6LfOERopAAAAAIcjQAWtjy-uONEWVbBuRVARJJob';
    private string $secretKey = '6LfOERopAAAAACdYWSmqoKwrW0OWTRf__5teCRrg';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'telephone' => 'required|min:4',
        'businessMcc' => 'required',
        'state' => 'required',
        'captcha' => 'required',
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'email.required' => 'O email é obrigatório',
        'email.email' => 'O email está com formato incorreto',
        'telephone.required' => 'O telefone é obrigatório',
        'businessMcc.required' => 'Escolha um tipo de negócio',
        'state.required' => 'Escolha um estado',
        'captcha.required' => 'O captcha é obrigatório',
    ];

    public function mount()
    {
        $this->populateLists();
    }
    public function render()
    {
        return view('livewire.contact-forms.dynamic');
    }

    public function debug()
    {
        $this->validate();
        $this->resetErrorBag();
        $this->sucess = true;
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->telephone,
            'region' => $this->state,
            'activityArea' => $this->businessMcc,
            'value' => (int) $this->invoicing,
            'emailOptIn' => 'yes',
            'whatsappOptIn' => 'yes',
            'mobileOptIn' => 'yes',
        ];

        $crmService = new CrmService($data, $this->rulerID);
        $crmService->send();
    }

    public function updatedCaptcha($token)
    {
        $response = Http::post(
            'https://www.google.com/recaptcha/api/siteverify?secret='.
            $this->secretKey.
            '&response='.$token
        );

        $success = $response->json()['success'];

        if (! $success) {
            throw ValidationException::withMessages([
                'captcha' => __('O Google não conseguiu verificar se você é um robô.'),
            ]);
        } else {
            $this->captcha = true;
        }
    }
    public function populateLists(): void
    {
        $mccList = [
            8211 => 'Escolas de Ensino Fundamental e Médio',
            8244 => 'Escolas de Administração e Secretariado - emitem somente certificado de participação',
            8220 => 'Faculdades, Universidades, Escolas Profissionalizantes - emitem diploma',
            8299 => 'Autoescolas, escolas de linguas, teatro, artes, culinária',
            6300 => 'Seguradoras - agentes de seguros - planos de saude',
            4899 => 'Serviços de Cabo, Satélite e Outros Serviços Pagos de Televisão e Rádio',
            5300 => 'Comércio Atacadista de alimentos (Makro, Sam\'s Club, etc)',
            4900 => 'Serviços Públicos (Eletricidade, Gás, Água, Saneamento Básico...)',
            9222 => 'Pagamento de multas (entidades governamentais)',
            9402 => 'Serviços Postais – Somente do Governo',
            8351 => 'Escolas infantis, creches e berçãrios',
            5411 => 'Supermercados',
            5441 => 'Docerias e Confeitarias',
            5462 => 'Padarias',
            5511 => 'Vendas de veículos novos - inclui serviços (concessionárias)',
            7997 => 'Clubes, Assoc Atléticas, Recreativas, Esportivas - exige sócio',
            8398 => 'Organizações, Serviço Social e de Caridade (não-políticas)',
            5571 => 'Vendas de motocicletas - inclui peças e acessórios como capacetes, luvas, etc)',
            8641 => 'Associações – Cívicas, Sociais e Fraternidades',
            5812 => 'Lanchonetes, Restaurantes, pizzarias',
            7011 => 'Hotéis, Pousadas, Motéis e Resorts',
            7531 => 'Funilaria/chapeação/pintura de Automóveis',
            4511 => 'Companhias Aéreas – Outras Classificações',
            7230 => 'Barbearias e Salões de Beleza',
            8661 => 'Organizações Religiosas',
            4816 => 'Provedores de internet / Serviços de Informação',
            5651 => 'Lojas de Roupas e acessórios - feminino, masculino e infantil',
            5996 => 'Venda de Piscinas e Suprimentos',
            7261 => 'Serviços Funerários e Crematórios',
            5521 => 'Vendas de veículos - somente usados',
            8111 => 'Advogados, Serviços Jurídicos',
            5551 => 'Boat Dealers',
            6051 => 'Casas de cambio',
            4119 => 'Serviços de Emergencia e Ambulâncias',
            8011 => 'Médicos',
            5599 => 'Vendas de outros veículos agrícolas (tratores, colheitadeiras) e recreativos (kart, carrinhos de golf, bugs, etc.)',
            5051 => 'Distribuidores de tubos e chapas metálicos, pregos, arames, barras, trilhos',
            7538 => 'Oficinas Automotivas',
            5039 => 'Materiais de Construção - Atacadistas/fabricantes de cimento, aço, conexões e outros',
            1520 => 'Empreiteiras de Construções Residenciais - Empreiteiros PF',
            1799 => 'Pedreiros',
            5046 => 'Distribuidores de equipamentos para cozinha industrial, balanças, acessórios para lojas, manequins',
            8062 => 'Hospitais',
            1740 => 'Serviços de alvenaria, trabalhos com pedras, reboco, isolamento e Colocação de Azulejos',
            5712 => 'Lojas de Móveis em Geral - Exceto eletrodomésticos',
            7641 => 'Serviços de Reparo Restauração de Móveis',
            5811 => 'Fornecedores de Comidas/Bebidas prontas para festas, casamentos e aviação',
            7512 => 'Locadoras de Automóveis',
            5971 => 'Galerias de Arte',
            4722 => 'Agências de Viagem e Operadoras de Turismo',
            4468 => 'Marinas - Serviços e vendas de produtos náuticos',
            5021 => 'Móveis - Fabricantes/distribuidores de móveis para escritorios, escolas, restaurantes, igrejas',
            7932 => 'Casas de Bilhar',
            5814 => 'Restaurantes de Fast-Food',
            5074 => 'Distribuidores de equip hidráulicos e de aquecimento (água e solar)',
            5935 => 'Serviços de Guincho e reboque',
            5169 => 'Atacadistas/distruibuidores de produtos quimicos',
            8021 => 'Dentistas, Ortodontistas',
            5532 => 'Lojas de Pneus',
            8043 => 'Oticas',
            5198 => 'Atacadistas/Distribuidores de Tintas, Vernizes e Suprimentos',
            5065 => 'Distribuidores de peças elétricas - capacitores, bobinas e outros',
            5099 => 'Fabricação de esquadrias de madeira e de peças de madeira para instalações industriais e comerciais e artigos de carpintaria par a construção.',
            8931 => 'Serviços de Contabilidade e Auditoria',
            5193 => 'Atacado de flores, sementes e suprimentos para floriculturas',
            5533 => 'Lojas de Autopeças e Acessórios para Veículos Automotivos',
            8099 => 'Clinicas e profissionais da Saúde (bancos de sangue, tratamento para dependencia quimica, fisioterapias, massoterapeutas, psicólogos, etc...)',
            7393 => 'Serviços de segurança privada, detetives e guarda-costas',
            1711 => 'Encanadores, consertos de ar condicionado, aquecimento, fornos e refrigeradores',
            5013 => 'Atacadistas/distribuidores de Peças e equipamentos para veículos',
            5231 => 'Lojas de tintas, vidro e papel de parede',
            742 => 'Veterinários e clínicas veterinárias',
            7534 => 'Borracharias',
            1731 => 'Eletricistas',
            7699 => 'Consertos de geladeiras, lavadoras de roupa e louça, secadoras',
            5085 => 'Distribuidores de abrasivos, rolamentos, válvulas hidráulicas',
            7399 => 'Outros Comércios - Não classificados anteriormente',
            7394 => 'Aluguel de Equipamentos, ferramentas e móveis',
            5072 => 'Distribuidores de ferragens em geral (parafusos, fechaduras, ferramentas manuais)',
            7342 => 'Serviços de Exterminação e Dedetização',
            1761 => 'Serralherias',
            7372 => 'Serviços de Programação e alteração de softwares, design de sites',
            7298 => 'Spas de Saúde e Beleza',
            7299 => 'Outros Serviços – Sem classificação',
            1750 => 'Carpinteiros',
            8911 => 'Serviços de Arquitetura, Engenharia e Topografia',
            7991 => 'Atrações e exposições turísticas',
            2741 => 'Atacadistas - Serviços de impressão, encadernação e editoração',
            7349 => 'Serviços de Limpeza e Manutenção, Zeladoria',
            7033 => 'Locais para Acampamento e Estacionamento de Trailers',
            7273 => 'Serviços de Encontros e Acompanhantes',
            5714 => 'Lojas de cortinas, persianas e materiais para tapeçaria',
            7361 => 'Agências de Emprego',
            7338 => 'Serviços de impressão e encadernação',
            5921 => 'Lojas de Bebidas (somente alcóolicas)',
            7941 => 'Clubes desportivos, arenas, estádios e escolas que fornecem formação esportiva, Profissional e Semiprofissional.',
            9311 => 'Pagamento de Impostos',
            9399 => 'Serviços Governamentais (cartórios, órgão da administração pública, taxas registro de veículos)',
            8734 => 'Laboratórios de Testes (exceto saúde) - alimentos, forense, ambiental, etc.',
            7296 => 'Serviços de Aluguel de Roupas e acessórios',
            5733 => 'Vendas de Instrumentos Musicais',
            763 => 'Cooperativas agrícolas',
            8071 => 'Laboratórios médicos e odontológicos - análises clínicas, raio-X, dentaduras, aparelhos ortodônticos',
            5139 => 'Distribuidores de produtos para fabricação de sapatos e botas',
            7911 => 'Academias/Estudios de Dança - Salões de Baile',
            5722 => 'Lojas de Aparelhos Eletrodomésticos',
            5047 => 'Distribuidores atacadistas de equipamentos de informática',
            5045 => 'Distribuidores atacadistas de equipamentos de informática',
            8049 => 'Podólogos e Quiropodistas',
            7221 => 'Estúdios Fotográficos e fotógrafos',
            5940 => 'Venda e Serviços de Reparos em Bicicletas',
            7631 => 'Consertos de Jóias e Relógios',
            7379 => 'Serviços de Reparos e Manutenção de Computadores',
            7392 => 'Serviços de Consultoria',
            4214 => 'Serviços de transporte rodoviário de cargas Local e de Longa Distancia - Serviços de Tele Entrega',
            780 => 'Jardinagem e paisagismo',
            7999 => 'Serviços de aluguel de bicicletas, pistas de patinação, campos de corrida kart, piscinas publicas, etc...',
            7311 => 'Serviços de Publicidade e Propaganda',
            5732 => 'Vendas de Eletrônicos (exceto celulares)',
            4225 => 'Serviços de Armazenagem de prod agrícolas, perecíveis, bens domésticos e mobiliários',
            5251 => 'Ferragens - varejo de materiais diversos (ferramentas, parafusos, suprimentos elétricos, etc)',
            7542 => 'Serviços de Lavagem de Automóveis - Lava Rápido',
            5122 => 'Distribuidores de medicamentos, produtos farmacêuticos e higiene pessoal',
            5199 => 'Materiais de Consumo não duráveis - não classificados',
            8999 => 'Profissionais - não classificados em outro MCC (empresas de pesquisa, planejadores financeiros, designers gráficos, casas de leilão, etc)',
            8031 => 'Osteopatas',
            8050 => 'Enfermarias e Casas de Repouso para idosos',
            5946 => 'Venda de Câmeras Fotográficas e Acessórios para fotografia',
            7922 => 'Vendas de Ingressos - Produções Artísticas',
            5451 => 'Lojas de Laticínios',
            5813 => 'Bar, Lounge, Discoteca, Clube Noturno',
            5944 => 'Joalherias, Relojoarias',
            5932 => 'Lojas de antiguidades - restauração, reparos e vendas',
            5094 => 'Distribuidores Pedras Preciosas, relógios, bijouterias, talheres e troféus',
            4789 => 'Transporte - outros (taxis de bicicleta, teleféricos, translado para aeroporto)',
            7832 => 'Cinema (inclui a bomboniere)',
            7929 => 'Orchestras not elsewhere classified',
            4784 => 'Pedágios e taxas em pontes e rodovias',
            5311 => 'Lojas de Departamentos',
            5422 => 'Açougues, peixarias e frutos do mar (frescos e congelados)',
            5200 => 'Homecenters (ex. C&C, Leroy Merlin, Tumelero, etc.)',
            7998 => 'Aquários e Zoológicos',
            5211 => 'Madeireiras - Varejistas de materiais de contrução',
            7339 => 'Serviços e suporte em revisão de textos, livros e currículos',
            5309 => 'Lojas Duty Free',
            2791 => 'Atacadistas - Serviços de impressão - tipografia e litografia',
            5697 => 'Tailors',
            5941 => 'Lojas de equipamentos esportivos (prancha, skate, patins, roller e assemelhados)',
            5131 => 'Piece Goods, Notions, and Other Dry Goods 1',
            5976 => 'Vendas de Produtos Protéticos e Ortopédicos',
            5713 => 'Lojas que vendem exclusivamente pisos e revestimentos - varejo',
            5137 => 'Distribuidores de uniformes - profissionais, esportivos e escolares',
            5999 => 'Lojas Diversas - não classificadas anteriormente',
            4812 => 'Lojas de Telefones Celulares, fixo e outros equip de comunicação',
            5992 => 'Floriculturas, Floristas',
            5977 => 'Perfumarias e Cosméticos',
            2842 => 'Atacadistas - Produtos de limpeza, polimento, antiferrugem e remoção de manchas',
            7216 => 'Lavanderias e Tinturarias',
            5942 => 'Livrarias e sebos',
            5719 => 'Loja especializada em móveis para casa',
            5950 => 'Lojas de Cristais (taças, castiçais, louças)',
            4121 => 'Taxistas e cooperativas de táxi, Limusines e serviços por aplicativo',
            7841 => 'Locadoras de Video',
            5661 => 'Lojas de Calçados',
            5983 => 'Distribuidores de Combustível - Madeira, carvão e petróleo liquefeito',
            5261 => 'Lojas de Suprimentos para Jardinagem (venda de grama, fertilizantes, ferramentas p/ jardinagem)',
            4112 => 'Transporte Ferroviário de Passageiros (não inclui metrô e trens urbanos)',
            5111 => 'Distribuidores por atacado de papelaria e material de escritório',
            7251 => 'Lavanderia de Chapéus, Sapateiros, Engraxatarias',
            5912 => 'Farmácias e Drogarias',
            7996 => 'Parques de Diversão, Circos, Cartomantes',
            5995 => 'Pet Shops',
            4131 => 'Linhas de Ônibus',
            5945 => 'Lojas de Brinquedo e jogos',
            5949 => 'Lojas de Tecidos / Armarinhos',
            7829 => 'Produtores e distribuidores de vídeos educacionais, treinamento, e comerciais',
            5331 => 'Lojas de Produtos com preços populares (ex. Lojas de "R$ 1,99")',
            5947 => 'Lojas de presentes, cartões e souveniers',
            5993 => 'Tabacarias',
            5541 => 'Postos de Combustíveis',
            5499 => 'Lojas de Alimentos especiais (Conveniência, empórios, delicatessens/alimentos dietéticos, naturais e suplementos)',
            5943 => 'Papelarias, material escolar e de escritório',
            5994 => 'Bancas de Jornal',
            4111 => 'Transportes de Passageiros Diários Suburbano e Local - metrô, trem e balsas (não inclui linhas de ônibus)',
            6513 => 'Agentes imobiliários e Corretores de Imóveis',
            5963 => 'Vendedores Porta a Porta',
            7523 => 'Estacionamentos e Garagens'
        ];

        $areasAtuacao = array(
            3 => 'Educação',
            4 => 'Alimentos / Bebidas',
            5 => 'Saúde',
            6 => 'Esporte / Lazer',
            7 => 'Beleza',
            8 => 'Roupas / Acessórios',
            9 => 'Comunicação',
            10 => 'Tecnologia',
            11 => 'Animais',
            12 => 'Combustíveis',
            13 => 'Automóveis / Motos / Peças',
            14 => 'Transportes / Logística',
            15 => 'Contabilidade',
            16 => 'Advocacia',
            17 => 'Indústria',
            18 => 'Agronegócio',
            19 => 'Assistência Técnica',
            20 => 'Publicidade',
            21 => 'Arte / Cultura / Entretenimento',
            22 => 'Serviços Financeiros',
            23 => 'Viagens',
            24 => 'Varejista',
            25 => 'Atacadista',
            26 => 'Construção',
            27 => 'Móveis / Decoração'
        );

        $this->mccList = $areasAtuacao;

        $this->invoicingList = [
            5000 => 'Até R$ 5.000,00',
            10000 => 'De R$ 5.000,00 a R$ 10.000,00',
            20000 => 'De R$ 10.000,00 a R$ 20.000,00',
            25000 => 'Acima de R$ 20.000,00'
        ];

        $statesList = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia ',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal ',
            'ES' => 'Espírito Santo ',
            'GO' => 'Goiás ',
            'MA' => 'Maranhão ',
            'MT' => 'Mato Grosso ',
            'MS' => 'Mato Grosso do Sul ',
            'MG' => 'Minas Gerais ',
            'PA' => 'Pará ',
            'PB' => 'Paraíba ',
            'PR' => 'Paraná ',
            'PE' => 'Pernambuco ',
            'PI' => 'Piauí ',
            'RJ' => 'Rio de Janeiro ',
            'RN' => 'Rio Grande do Norte ',
            'RS' => 'Rio Grande do Sul ',
            'RO' => 'Rondônia ',
            'RR' => 'Roraima ',
            'SC' => 'Santa Catarina ',
            'SP' => 'São Paulo ',
            'SE' => 'Sergipe ',
            'TO' => 'Tocantins '
        ];

        $this->statesList = $statesList;
    }
}

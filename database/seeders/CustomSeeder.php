<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\LaravelSettings\Models\SettingsProperty;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'question' => 'O que é a maquininha PASSOU GANHOU?',
            'answer' => 'A PASSOU GANHOU é o meio de pagamento físico da EBW Bank. São quatro modelos de maquininhas diferentes, disponíveis para o empreendedor que deseja ser atendido com exclusividade e pagar taxas personalizadas, justas e adequadas a cada estabelecimento.'
        ]);
        Faq::create([
            'question' => 'Qual a PASSOU GANHOU ideal para mim?',
            'answer' => 'Cada uma das maquininhas tem uma característica especial. Se boa parte das suas vendas acontece por delivery, a Enjoy pode ser a sua escolha, porque é leve e portátil. Se as suas vendas são bem divididas, entre delivery e vendas no balcão, a Revolution é a sua melhor pedida. Agora, se você quer vender com tecnologia, a Ultra é a maquininha ideal pra você. Já a PASSOU GANHOU TEF permite agilidade e transparência para o seu PDV.'
        ]);
        Faq::create([
            'question' => 'Como pedir a minha maquininha?',
            'answer' => 'Você tem três opções. Vale pedir pelo whatsApp clicando AQUI (61) 9.9604-4061. Se preferir, pode pedir fazendo uma ligação gratuita para o 0800-000-1678. Ou, ainda, solicitar pelo site <a href="https://passouganhou.com.br/cadastros/cadastrar-pf" target="_blank" class="underline" style="color: blue">clicando aqui</a>.'
        ]);
        Faq::create([
            'question' => 'Em quanto tempo vou receber a minha maquininha PASSOU GANHOU?',
            'answer' => 'Para empreendedores de São Paulo (capital) e Brasília, a maquininha chega em até 24 horas. Para os demais estados, o prazo de envio pode variar, mas fique tranquilo! Nossos consultores vão te orientar caso a caso.'
        ]);
        Faq::create([
            'question' => 'Quais os canais de contato com a PASSOU GANHOU',
            'answer' => 'A PASSOU GANHOU oferece vários canais de comunicação com o cliente. Nosso atendimento é totalmente humanizado. Aqui, você não será atendido por um robe. O primeiro deles é o 0800-000-1678. Mas se você prefere conversar pelo WhatsApp, basta entrar em contato pelo (61) 9.9604-4061. O nosso atendimento é sempre de segunda a sexta-feira, das 8h às 18h. Você também pode pedir a sua maquininha pelo e-mail: <a href="mailto:vendas@passouganhou.com.br" class="underline" style="color: blue" >vendas@passouganhou.com.br</a>.'
        ]);
        Faq::create([
            'question' => 'Estou enfrentando problemas técnicos com a maquininha. O que fazer?',
            'answer' => 'Basta entrar em contato com o nosso suporte pelo whatsApp (61) 9.9604-1988. Se preferir, peça informações pelo e-mail <a href="mailto:suporte@passouganhou.com.br" class="underline" style="color: blue">suporte@passouganhou.com.br</a>. Na PASSOU GANHOU, você será atendido por uma equipe de verdade. Não tem essa de atendimento feito por robôs.'
        ]);
        Faq::create([
            'question' => 'Como são os prazos de antecipação?',
            'answer' => "
            A PASSOU GANHOU oferece três tipos de antecipação:<br><br>

            - Antecipação Automática: Nesse caso, todas as transações feitas no dia serão creditadas, como regra, em até 24 horas, na conta indicada em contrato, sem necessidade de o cliente solicitar a antecipação diariamente. (D+1) <br>
            - Antecipação Pontual: Utilizada pelo cliente em caso de uma necessidade pontual. Nesse caso, o cliente deve fazer a solicitação pelos canais de atendimento da PASSOU GANHOU, já usualmente utilizados pelo cliente, como WhatsApp ou pelo 0800-894-3000. Em caso de antecipação pontual, a venda total do dia também será creditada, em até 24 horas, na conta indicada pelo cliente, em contrato. (D+1). <br>
            - Antecipação programada: Ao optar por esse modelo de antecipação, o cliente recebe as contas acumuladas dos últimos sete dias, sempre no dia útil posterior desse conjunto de dias. (D+7). A solicitação por essa opção também deve ser feita, utilizando-se os canais já usualmente utilizados pelo cliente.
            "
        ]);

        SettingsProperty::query()
            ->updateOrCreate([
                'group' => 'faq',
                'name' => 'maquininhas'
            ], [
                'payload' => '[
                    {
                        "name": "C680",
                        "operation": [
                            {
                                "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol>",
                                "title": "Primeira Venda"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 2 – <strong>ESTORNAR</strong></li><li>Escolha a opção da venda: Débito ou Crédito</li><li>Coloque a data da transação</li><li>Digite o valor da venda</li><li>Digite o número de documento da transação a ser cancelada (NSU BERGS ex: 01234567, fica abaixo da data de transação)</li><li>Insira ou passe o cartão e o retire na sequência</li></ol><p><br></p>",
                                "title": "Estorno"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 5 – <strong>COMPROVANTE DE VENDA</strong></li><li>Depois, opção 2 –<strong> ÚLTIMO COMPROVANTE</strong></li><li>Conf. Reimpressão – Sim</li></ol><p><br></p>",
                                "title": "Reimpressão de venda"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 1- <strong>TIPO DE CONEXÃO</strong></li><li>Escolha a conexão desejada</li><li>1: conectar Wi-fi (escolher a rede e depois digitar a senha)</li><li>2: conectar GPRS (opção 2 novamente / 2 – virtueyes)</li></ol><p><br></p>",
                                "title": "Conexão Wi-fi e GPRS"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 3</li><li>Relatório resumido</li><li>Relatório detalhado (Nessa opção, você pode colocar a quantidade de dias que deseja o relatório)</li></ol><p><br></p>",
                                "title": "Relatório de vendas"
                            }
                        ],
                        "sub_title": "Pedi uma maquininha C680 e quero saber mais sobre o funcionamento",
                        "description": "Calma, aqui você vai encontrar o passo a passo das principais funções. Vamos lá! ",
                        "featured_image": "0irnxdOGA4KbfoZR1ep7whcL2ZbQXx-metaaWNvbi1tYXF1aW5pbmhhLnBuZw==-.png"
                    },
                    {
                        "name": "S920",
                        "operation": [
                            {
                                "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Em caso de venda no Crédito, escolha a opção <strong>“À VISTA” ou “PARCELADO”</strong></li><li>Se a escolha for por venda no Débito, digite a senha e aperte a seta <strong>verde&nbsp;</strong></li><li>Na opção “<strong>À VISTA”</strong>, digite a senha e aperte a tecla <strong>verde</strong></li><li>No <strong>“PARCELADO”</strong>, o estabelecimento digita a quantidade de parcelas. Cliente coloca a senha e a operação deve ser confirmada na tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>“PARCELADO PELA ADM”</strong></li></ol>",
                                "title": "Primeira Venda"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 4: <strong>ESTORNO</strong></li><li>Escolha a opção da venda: Débito ou Crédito</li><li>Insira a data da transação</li><li>Insira o valor da venda</li><li>Digite o número de documento da transação a ser cancelada (NSU BERGS ex: 01234567, fica abaixo da data de transação</li></ol><p><br></p>",
                                "title": "Estorno"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Aperte na <strong>SETA</strong>, que fica ao lado de <strong>CANCELAR</strong></li><li>Escolha a opção 2: <strong>COMPROVANTE DE VENDA</strong></li><li>Selecione a opção 2: <strong>ÚLTIMO COMPROVANTE</strong></li><li>Confirme a reimpressão</li></ol><p><br></p>",
                                "title": "Reimpressão de venda"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 3: TIPO DE CONEXÃO</li><li>Se optar pelo Wi-fi, escolha a rede e coloque a senha</li><li>Se optar pelo Chip- GPRS:<ol><li>Escolha a opção 4: <strong>CONFIGURAR GPRS</strong></li><li>Na sequência, escolha a opção 2: LISTA DE APN</li><li>Escolher: Virtueyes (que é a operadora do CHIP)</li></ol></li></ol><p><br></p>",
                                "title": "Conexão Wi-fi e GPRS"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong></li><li>Escolha a opção 5: <strong>RELATÓRIO</strong></li><li>Escolha a opção desejada</li><li>Resumido/ detalhado/ resumido diário/ resumido período. (na opção relatório detalhado, você pode colocar a quantidade de dias que deseja o relatório)</li></ol><p><br></p>",
                                "title": "Relatório de vendas"
                            }
                        ],
                        "sub_title": "Minha maquininha é a S920. O que fazer?",
                        "description": "Vamos lá! A nossa equipe preparou um tutorial pra você, com as principais funções. ",
                        "featured_image": "0irnxdOGA4KbfoZR1ep7whcL2ZbQXx-metaaWNvbi1tYXF1aW5pbmhhLnBuZw==-.png"
                    },
                    {
                        "name": "A910",
                        "operation": [
                            {
                                "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Em caso de venda no Crédito, escolha a opção <strong>“À VISTA” ou “PARCELADO”</strong></li><li>Se a escolha for pela venda no Débito, digite a senha e aperte a seta <strong>verde</strong></li><li>Na opção <strong>“À VISTA”</strong>, digite a senha e aperte a tecla <strong>verde</strong></li><li>No <strong>“PARCELADO”</strong> estabelecimento digite a quantidade de parcelas, a senha e confirme na tecla verde.</li><li>Se a taxa de juros for cobrada do cliente, use a opção<strong> “PARCELADO PELA ADM”</strong></li></ol>",
                                "title": "Primeira Venda"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU </strong>(são três barras que ficam ao lado de <strong>VENDAS </strong>na parte verde superior)</li><li>Selecione <strong>“PAGAMENTOS”</strong></li><li>Depois,<strong> ESTORNO DE VENDAS</strong></li><li>Selecione a data da transação (irá abrir um calendário. Basta escolher e apertar em <strong>“OK”</strong>)</li><li>Escolha o tipo de estorno (Débito ou Crédito)</li><li>Digite o valor a ser estornado</li><li>Digite o número de documento da transação a ser estornada (NSU BERGS ex: 01234567, fica abaixo da data de transação)</li><li>Insira ou passe o cartão e, logo depois, retire o cartão</li></ol><p><br></p>",
                                "title": "Estorno"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU</strong> (são três barras que ficam ao lado de <strong>VENDAS </strong>na parte verde superior)</li><li>Escolha: <strong>REENVIAR CUPOM</strong></li><li>Selecione <strong>ÚLTIMA TRANSAÇÃO</strong></li></ol><p><br></p>",
                                "title": "Reimpressão de venda"
                            },
                            {
                                "items": "<ol><li>Desça a barra da parte superior da máquina</li><li>Escolha Wi-fi ou 4G</li><li>Caso o <strong>GPRS </strong>não conecte. Estamos à sua disposição pelo nosso canal de <strong>SUPORTE</strong>. Chame no whats (61) 99604-1988</li></ol><p><br></p>",
                                "title": "Conexão Wi-fi e GPRS"
                            },
                            {
                                "items": "<ol><li>Vá em <strong>MENU </strong>(são três barras que ficam ao lado de VENDAS na parte verde superior)</li><li>Selecione<strong> “RELATÓRIOS”</strong></li><li>Escolha a opção desejada</li><li>Detalhado/ Resumido/ Resumido por Bandeira</li><li>Aperte na opção <strong>“GERAR”</strong></li></ol><p><br></p>",
                                "title": "Relatório de vendas"
                            }
                        ],
                        "sub_title": "Acompanhe.",
                        "description": "Ok. A sua maquininha perfeita é A910? Também temos um passo a passo pra você.",
                        "featured_image": "0irnxdOGA4KbfoZR1ep7whcL2ZbQXx-metaaWNvbi1tYXF1aW5pbmhhLnBuZw==-.png"
                    }
                ]'
            ]);
    }
}

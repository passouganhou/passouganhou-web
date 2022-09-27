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
            'answer' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, molestias. Dicta aut eum quasi qui accusantium cupiditate reprehenderit nemo assumenda placeat. Eos voluptas aliquid repellendus qui rerum sapiente harum molestias?'
        ]);
        Faq::create([
            'question' => 'Qual a PASSOU GANHOU ideal para mim?',
            'answer' => 'Cada uma das maquininhas tem uma característica especial. Se boa parte das suas vendas acontece por delivery, a Enjoy pode ser a sua escolha, porque é leve e portátil. Se as suas vendas são bem divididas, entre delivery e vendas no balcão, a Revolution é a sua melhor pedida. Agora, se você quer vender com tecnologia, a Ultra é a maquininha ideal pra você. Já a PASSOU GANHOU TEF permite agilidade e transparência para o seu PDV.'
        ]);
        Faq::create([
            'question' => 'Como pedir a minha maquininha?',
            'answer' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, molestias. Dicta aut eum quasi qui accusantium cupiditate reprehenderit nemo assumenda placeat. Eos voluptas aliquid repellendus qui rerum sapiente harum molestias?'
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
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Estorno"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Reimpressão de venda"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Conexão Wi-fi e GPRS"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Relatório de vendas"
                        }
                    ],
                    "description": "Ok. A sua maquininha perfeita é A910? Também temos um passo a passo pra você.",
                    "featured_image": "0irnxdOGA4KbfoZR1ep7whcL2ZbQXx-metaaWNvbi1tYXF1aW5pbmhhLnBuZw==-.png"
                },
                {
                    "name": "S920",
                    "operation": [
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol>",
                            "title": "Primeira Venda"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Estorno"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Reimpressão de venda"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Conexão Wi-fi e GPRS"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Relatório de vendas"
                        }
                    ],
                    "description": "Ok. A sua maquininha perfeita é A910? Também temos um passo a passo pra você.",
                    "featured_image": "0irnxdOGA4KbfoZR1ep7whcL2ZbQXx-metaaWNvbi1tYXF1aW5pbmhhLnBuZw==-.png"
                },
                {
                    "name": "A910",
                    "operation": [
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol>",
                            "title": "Primeira Venda"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Estorno"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Reimpressão de venda"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Conexão Wi-fi e GPRS"
                        },
                        {
                            "items": "<ol><li>Digite o valor da venda e aperta a tecla <strong>verde</strong></li><li>Selecione a opção Crédito ou Débito</li><li>Insira o cartão</li><li>Venda Débito - Digite senha e aperta a seta <strong>verde</strong></li><li>Venda Crédito - escolha a opção <strong>\"À VISTA\" ou \"PARCELADO\"</strong></li><li>Na opção \"À VISTA\", digite senha e aperta a tecla <strong>verde</strong></li><li>Se a taxa de juros for cobrada do cliente, use a opção <strong>\"PARCELADO PELA ADM\"</strong></li></ol><p><br></p>",
                            "title": "Relatório de vendas"
                        }
                    ],
                    "description": "Ok. A sua maquininha perfeita é A910? Também temos um passo a passo pra você.",
                    "featured_image": "0irnxdOGA4KbfoZR1ep7whcL2ZbQXx-metaaWNvbi1tYXF1aW5pbmhhLnBuZw==-.png"
                }
            ]'
            ]);
    }
}

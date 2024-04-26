<div class="container border rounded-md hidden" id="resumo-wrapper">
    <h4 class="text-lg font-bold">Resumo</h4>
    <div id="resumo">
        <h3 class="font-semibold">Visa/Master</h3>
        <p id="resumo_visa_master"></p>
        <h3 class="font-semibold">Elo/Amex</h3>
        <p id="resumo_elo_amex"></p>
        <h3 class="font-semibold">Pix</h3>
        <p id="resumo_pix"></p>
    </div>

    <div class="" id="p_anticipation_value_hideable">
        <p>
            <span class="font-semibold">Valor da Antecipação Automática: </span><span id="p_anticipation_value">R$ 0,00</span>
        </p>
    </div>

    @if($sendToRD)
        <div class="flex flex-col gap-2">
            <button type="button" class="bg-passou-magenta text-white px-4 py-2 rounded-md" id="send_to_rd" onclick="sendToRD(event)"
            >Enviar para o RD</button>
            <a href="{{ route('rd.negociacoes') }}" class="bg-passou-magenta text-white px-4 py-2 rounded-md hidden" id="voltar_negociacoes">Voltar para negociações</a>
            <div class="hidden" id="send_to_rd_message">
                <p class="text-green-500">Proposta enviada com sucesso!</p>
            </div>
        </div>
    @endif

</div>

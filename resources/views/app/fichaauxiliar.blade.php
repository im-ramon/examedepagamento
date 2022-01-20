<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
    <title>Ficha Auxiliar</title>

    <style>
        td.td_calculos {
            border: 1px solid rgb(54, 54, 54);
            text-align: center;
        }

        td.td_assinatura {
            border: 1px solid rgb(255, 255, 255);
            text-align: center;
        }

        td.td_cabecalho {
            padding: 0 .5em;
            text-align: left
        }

    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th class="td_cabecalho" style="text-align: center;" colspan="11">
                <p>FICHA AUXILIAR</p>
            </th>
        </tr>
        <tr>
            <td class="td_cabecalho" style="text-align: left;">
                <p>UG:</p>
            </td>
            <td class="td_cabecalho" colspan="3">
                <p>35º BI</p>
            </td>
            <td class="td_cabecalho">
                <p>M&Ecirc;S:</p>
            </td>
            <td class="td_cabecalho" colspan="6">
                <p>SET/21</p>
            </td>
        </tr>
        <tr>
            <td class="td_cabecalho">
                <p>NOME:</p>
            </td>
            <td class="td_cabecalho" colspan="5">
                <p>RAMON OLIVEIRA DOS SANTOS</p>
            </td>
            <td class="td_cabecalho">
                <p>P/G:</p>
            </td>
            <td class="td_cabecalho">
                <p>{{ $informacoes['pg_real_info']['pg_abrev'] }}</p>
            </td>
        </tr>
        <tr>
            <td class="td_cabecalho">
                <p>IDT:</p>
            </td>
            <td class="td_cabecalho" colspan="2">
                <p>060134543-4</p>
            </td>
            <td class="td_cabecalho">
                <p>CPF:</p>
            </td>
            <td class="td_cabecalho" colspan="9">
                <p>000.000.000-00</p>
            </td>
        </tr>
        <tr>
            <td class="td_calculos" rowspan="18">
                <p>R</p>
                <p>E</p>
                <p>C</p>
                <p>E</p>
                <p>I</p>
                <p>T</p>
                <p>A</p>
                <p>S</p>
            </td>
            <td class="td_calculos" colspan="2">
                <p>DISCRIMINA&Ccedil;&Atilde;O</p>
            </td>
            <td class="td_calculos">
                <p>%</p>
            </td>
            <td class="td_calculos">
                <p>VALOR<br>PESQUISADO</p>
            </td>
            <td class="td_calculos" colspan="2">
                <p>VALOR<br>CONTRACHEQUE</p>
            </td>
            <td class="td_calculos" colspan="4">
                <p>OBSERVA&Ccedil;&Otilde;ES</p>
            </td>
        </tr>

        @isset($receitas)
            @php
                $contador = 0;
            @endphp

            @foreach ($receitas as $indice => $valor)

                @if ($valor['valor'] > 0 and $valor['rubrica'] != 'BRUTO TOTAL' and $valor['rubrica'] != 'BRUTO PARA IR')
                    <tr>
                        <td class="td_calculos" colspan="2">
                            {{ $valor['rubrica'] }}
                        </td>
                        <td class="td_calculos">
                            <!-- % AQUI -->
                        </td>
                        <td class="td_calculos">
                            {{ $valor['valor'] }}
                        </td>
                        <td class="td_calculos" colspan="2">
                            <span>R$ </span><input type="number" value="{{ $valor['valor'] }}" step="0.01">
                        </td>
                        <td class="td_calculos" colspan="4">
                            <p>
                                <!-- VALOR OBSERVAÇÕES AQUI -->
                                <br> <!-- para não sumir a linha -->
                            </p>
                        </td>
                    </tr>
                    @php
                        $contador++;
                    @endphp
                @endif

            @endforeach

            {{-- Esse for é acionado caso não tenha pelos 18 Rúbricas --}}
            @for ($i = $contador; $i < 17; $i++)
                <tr>
                    <td class="td_calculos" colspan="2">
                        <!-- RUBRICA AQUI -->
                    </td>
                    <td class="td_calculos">
                        <!-- % AQUI -->
                    </td>
                    <td class="td_calculos">
                        <!-- VALOR AQUI -->
                    </td>
                    <td class="td_calculos" colspan="2">
                        <!-- VALOR CONTRACHQUE AQUI -->
                    </td>
                    <td class="td_calculos" colspan="4">
                        <p>
                            <!-- VALOR OBSERVAÇÕES AQUI -->
                            <br> <!-- para não sumir a linha -->
                        </p>
                    </td>
                </tr>
            @endfor

        @endisset

        <!-- DESCONTOS -->
        <tr>
            <td class="td_calculos" rowspan="18">
                <p>D</p>
                <p>E</p>
                <p>S</p>
                <p>P</p>
                <p>E</p>
                <p>S</p>
                <p>A</p>
                <p>S</p>
            </td>
            <td class="td_calculos" colspan="2">
                <p>DISCRIMINA&Ccedil;&Atilde;O</p>
            </td>
            <td class="td_calculos">
                <p>%</p>
            </td>
            <td class="td_calculos">
                <p>VALOR<br>PESQUISADO</p>
            </td>
            <td class="td_calculos" colspan="2">
                <p>VALOR<br>CONTRACHEQUE</p>
            </td>
            <td class="td_calculos" colspan="4">
                <p>OBSERVA&Ccedil;&Otilde;ES</p>
            </td>
            @isset($descontos)
                @php
                    $contador = 0;
                @endphp

                @foreach ($descontos as $indice => $valor)

                    @if ($valor['valor'] > 0 and $valor['rubrica'] != 'DESCONTOS TOTAL' and $valor['rubrica'] != 'DESCONTOS PARA IR')
            <tr>
                <td class="td_calculos" colspan="2">
                    {{ $valor['rubrica'] }}
                </td>
                <td class="td_calculos">
                    <!-- "%" AQUI -->
                </td>
                <td class="td_calculos">
                    {{ $valor['valor'] }}
                </td>
                <td class="td_calculos" colspan="2">
                    <span>R$ </span><input type="number" value="{{ $valor['valor'] }}" step="0.01">
                </td>
                <td class="td_calculos" colspan="4">
                    <p>
                        <!-- VALOR OBSERVAÇÕES AQUI -->
                        <br> <!-- para não sumir a linha -->
                    </p>
                </td>
            </tr>
            @php
                $contador++;
            @endphp
            @endif

            @endforeach

            {{-- Esse for é acionado caso não tenha pelos 18 Rúbricas --}}
            @for ($i = $contador; $i < 17; $i++)
                <tr>
                    <td class="td_calculos" colspan="2">
                        <!-- RUBRICA AQUI -->
                    </td>
                    <td class="td_calculos">
                        <!-- % AQUI -->
                    </td>
                    <td class="td_calculos">
                        <!-- VALOR AQUI -->
                    </td>
                    <td class="td_calculos" colspan="2">
                        <!-- VALOR CONTRACHQUE AQUI -->
                    </td>
                    <td class="td_calculos" colspan="4">
                        <p>
                            <!-- VALOR OBSERVAÇÕES AQUI -->
                            <br> <!-- para não sumir a linha -->
                        </p>
                    </td>
                </tr>
            @endfor

        @endisset
        <tr>
            <td class="td_calculos" colspan="4">
                <p>SOMA</p>
            </td>
            <td class="td_calculos">
                <!-- SOMA VALOR PESQUISADO AQUI -->
            </td>
            <td class="td_calculos" colspan="2">
                <p>
                    <!-- SOMA VALOR CONTRACHEQUE AQUI -->
                </p>
            </td>
            <td class="td_calculos" colspan="4">
                <p>
                    <!-- SOMA VALOR CONTRACHEQUE AQUI -->
                </p>
            </td>
        </tr>
        <tr>
            <td class="td_calculos" colspan="4">
                <p>LIQUIDO A RECEBER</p>
            </td>
            <td class="td_calculos">
                <p>
                    <!-- LIQUIDO DO VALOR PESQUISADO AQUI -->
                </p>
            </td>
            <td class="td_calculos" colspan="2">
                <p>
                    <!-- LIQUIDO DO VALOR CONTRACHEQUE AQUI -->
                </p>
            </td>
            <td class="td_calculos" colspan="4">
                <p>
                    <!-- OBSERVAÇÕES AQUI -->
                </p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <p>Feira de Santana/BA, 20 de janeiro de 2022.</p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <p><strong>RAMON OLIVEIRA DOS SANTOS - 3º Sgt</strong></p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <p>Membro da Equipe</p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <p><strong>RAMON OLIVEIRA DOS SANTOS - 3º Sgt</strong></p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <p>Chefe da Equipe</p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
                <p>ESTA FICHA DEVER&Aacute; FICAR &Agrave; DISPOSI&Ccedil;&Atilde;O DOS &Oacute;RG&Atilde;OS DE CONTROLE
                    INTERNO E EXTERNO, POR UM PER&Iacute;ODO NUNCA INFERIOR A UM ANO.</p>
            </td>
        </tr>
    </table>
</body>

</html>

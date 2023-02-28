<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Seja bem-vindo ao site <b>Investimentos e Moedas</b></h1>
    <hr>
    <section>
        <h2>Investimentos</h2>
    </section>
    <section>
        <h2>Moedas</h2>
        <div>
            <p id="m_dolar">X reais</p>
            <p id="m_euro">X reais</p>
            <p id="m_esterlina">X reais</p>
            <p id="m_iene">X reais</p>
        </div>
    </section>
</body>
</html>

<?php
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $moedas_source = file_get_contents('https://br.investing.com/currencies/exchange-rates-table', false, $context);
    $acoes_source = file_get_contents('https://br.investing.com/equities/brazil', false, $context);
    
    $moedas_table = substr($moedas_source,
                strpos($moedas_source,'<section id="leftColumn" class="">'),
                11500);

    $acoes_source = substr($acoes_source,
                strpos($moedas_source,'<table id="cross_rate_markets_stocks_1" tablesorter=""')+159450,75300);

    $dolar = substr($moedas_table,
                strpos($moedas_table,'<td class="pid-2103-last" id="last_12_35">') +43,
                6);
    $euro = substr($moedas_table,
                strpos($moedas_table,'<td class="pid-1617-last" id="last_17_35">') +43,
                6);

    $esterlina = substr($moedas_table,
                strpos($moedas_table,'<td class="pid-1736-last" id="last_3_35">') +42,
                6);

    $iene = substr($moedas_table,
                strpos($moedas_table,'<td class="pid-1890-last" id="last_2_35">') +42,
                6);
?>

<script>
    var m_dolar = document.getElementById("m_dolar");
    var m_euro = document.getElementById("m_euro");
    var m_esterlina = document.getElementById("m_esterlina");
    var m_iene = document.getElementById("m_iene");
    m_dolar.textContent = "Dolar: " + <?php echo json_encode($dolar, JSON_HEX_TAG); ?> + " reais";
    m_euro.textContent = "Euro: " + <?php echo json_encode($euro, JSON_HEX_TAG); ?> + " reais";
    m_esterlina.textContent = "Libra Esterlina: " + <?php echo json_encode($esterlina, JSON_HEX_TAG); ?> + " reais";
    m_iene.textContent = "Iene Japonês: " + <?php echo json_encode($iene, JSON_HEX_TAG); ?> + " reais";
</script>

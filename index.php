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
        <h4>Moeda Principal</h4>
        <select id="m_select" onchange="Rechange()">
            <option value="Real" selected>Real</option>
            <option value="Dolar">Dolar</option>
            <option value="Euro">Euro</option>
        </select>
        <br>
        <h2>Moedas</h2>
        <div>
            <p>Dolár</p>
            <p id="m_dolar">X reais</p>
        </div>
    </section>
</body>
</html>
<script>
    function Rechange() {
        var m_dolar = document.getElementById("m_dolar");
        var m_select = document.getElementById("m_select");
        switch (m_select.value) {
            case "Real":
                m_dolar.textContent = "5.4100 reais";
                break;
            case "Dolar":
                m_dolar.textContent = "1 dolar";
                break;
            case "Euro":
                m_dolar.textContent = "0,9614 Euros";
                break;
            default:
                break;
        }
    }
    Rechange();
</script>

<?php
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $source = file_get_contents('https://br.investing.com/currencies/exchange-rates-table', false, $context);
    $table = substr($source,
                strpos($source,'<section id="leftColumn" class="">'),
                13000);
    print($table);

?>
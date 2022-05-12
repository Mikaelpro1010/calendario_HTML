<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>

<body>
  <input type="date" name="entrada_date" id="entrada_date" onchange="javascript:novaHora()" />
  <input type="number" name="qnt_dias" id="qtd_dias" placeholder="Informe a quantidade de dias:" onchange="javascript:novaHora()" />
  <fieldset>
    <legend>Selecione o tipo de dia a ser contado:</legend>

    <div>
      <input type="radio" id="dias_corridos" name="Dias" value="dias_corridos" checked>
      <label for="dias_corridos">Dias corridos</label>
    </div>

    <div>
      <input type="radio" id="dias_uteis" name="Dias" value="dias_uteis" />
      <label for="dias_uteis">Dias úteis</label>
    </div>
  </fieldset>
  <input type="date" name="data" id="data" onchange="javascript:novaHora()" />
  <span id="msgAlerta"></span>
</body>
</htm>

<script>
  function date_saida(data) {
    let day_result = (data.getDate())
    day_result = (data.getDate() <= 9) ? "0" + day_result : day_result;
    let month_result = (data.getMonth() + 1);
    month_result = ((data.getMonth() + 1) <= 9) ? "0" + month_result : month_result;
    let year_result = (data.getFullYear());

    return year_result + "-" + month_result + "-" + day_result;
  }

  function novaHora() {
    let feriado = ['2022-06-09', '2022-06-20', '2022-06-21', '2022-06-30'];
    let msgAlerta = document.getElementById('msgAlerta');
    let quant_days = document.getElementById('qtd_dias').value;
    let types_of_days = document.getElementsByName('Dias').value;
    let number = document.getElementById('entrada_date').value;
    let data = new Date(number + ' 00:00:00');
    date_saida(data);
    let x = parseInt(quant_days);

    data.setDate(data.getDate() + x);
    // for(data=0;data<feriado.length;data++){
    //   const conteudo = feriado.includes(data);
    //   /*if(data==indicie_feriado[i]){
    //   msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Encontrado final de semana, favor selecionar outra quantidade de dias!</div>';
    //   }*/
    // }
    if (data.getDay() == 0 || data.getDay() == 6) {
      msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Encontrado final de semana, favor selecionar outra quantidade de dias!</div>';
    } else {
      document.getElementById("data").value = date_saida(data);
    }

  }
</script>
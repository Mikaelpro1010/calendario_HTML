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
    let feriado = ['2022-05-12', '2022-06-20', '2022-06-21', '2022-06-30'];
    let msgAlerta = document.getElementById('msgAlerta');
    let quant_days = document.getElementById('qtd_dias').value;
    let types_of_days_corridos = document.getElementById('dias_corridos').checked;
    let types_of_days_uteis = document.getElementById('dias_uteis').checked;
    console.log(types_of_days_uteis)
    let number = document.getElementById('entrada_date').value;
    if (number != "" && quant_days != "") {
      if (types_of_days_corridos) {
        let data = new Date(number + ' 00:00:00');
        let x = parseInt(quant_days);

        data.setDate(data.getDate() + x);

        if (data.getDay() == 0) {
          msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Domingo, favor selecionar outra quantidade de dias!</div>';
        } else if (data.getDay() == 6) {
          msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Sábado, favor selecionar outra quantidade de dias!</div>';
        } else if (feriado.includes(date_saida(data))) {
          msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Encontrado um feriado, favor selecionar outra quantidade de dias!</div>';
        }
      }

      if (types_of_days_uteis) {
        let data = new Date(number + ' 00:00:00');

        while (1) {
          data.setDate(data.getDate() + 1);
          quant_days -= 1;
          if (data.getDay() == 0 || data.getDay() == 6 || feriado.includes(date_saida(data))) {
            quant_days += 1;
          } 
          if (quant_days == 0) {
            break;
          }
        }
        
      }
    }
    document.getElementById("data").value = date_saida(data);
  }
</script>
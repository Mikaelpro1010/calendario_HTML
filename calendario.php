<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Document</title>

</head>

<body class="mt-3">
	<h2 class="text-center">Contador de datas</h2>
	<hr>
	<div class="mb-3">
		<div class="container">
			<div class="d-flex flex-row-reverse">
				<a class="btn btn-primary" href="http://localhost/cadastrar_datas/cadastrar_datas.php">Acesso a listagem de datas</a>
			</div>
			<div>
				<form class="row g-3">
					<div class="col-md-6">
						<label for="inputEmail4" class="form-label">Insira a data desejada:</label>
						<!--funcionalidade para incrementar a data desejada-->
						<input type="date" name="entrada_date" id="entrada_date" onchange="javascript:novaHora()" class="form-control" />
					</div>
					<div class="col-md-6">
						<label for="inputPassword4" class="form-label">Informe a quantidade:</label>
						<!--funcionalidade para incrementar a quantidade de dias -->
						<input type="number" name="qnt_dias" id="qtd_dias" placeholder="Informe a quantidade de dias:" onchange="javascript:novaHora()" class="form-control" />
					</div>
					<div class="col-md-12">
						<fieldset class="border border-dark p-2 rounded">
							<p>Selecione o tipo de dia a ser contado:</p>
							<!--funcionalidade para escolher entre dias úteis e dias corridos-->

							<div>
								<input type="radio" id="dias_corridos" name="Dias" value="dias_corridos" checked>
								<label for="dias_corridos">Dias corridos</label>
							</div>

							<div>
								<input type="radio" id="dias_uteis" name="Dias" value="dias_uteis" />
								<label for="dias_uteis">Dias úteis</label>
							</div>
					</div>
					</fieldset>
					<div class="col-md-6">
						<label for="inputPassword4" class="form-label">Resultado da nova data gerada:</label>
						<!--funcionalidade para exibir a nova data após o acréscimo de dias -->
						<input type="date" name="data" id="data" onchange="javascript:novaHora()" class="form-control" />
						<!--funcionalidade para exibir mensagem de  alerta caso caia em um fim de semana ou feriado -->
						<span id="msgAlerta"></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</htm>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>

	let feriado = listarFeriados();
	/*funcinalidade para formatar o valor no formato padrão de datas(yyyy-mm-dd)*/
	function date_saida(data) {
		let day_result = (data.getDate());
		day_result = (data.getDate() <= 9) ? "0" + day_result : day_result;
		let month_result = (data.getMonth() + 1);
		month_result = ((data.getMonth() + 1) <= 9) ? "0" + month_result : month_result;
		let year_result = (data.getFullYear());

		return year_result + "-" + month_result + "-" + day_result;
	}

	function novaHora() {
		/*funcionalidade para armazenar os valores recebidos pelo usário e tratálos para serem exibidos na tela do site*/
		//let feriado = ['2022-05-12', '2022-06-20', '2022-06-21', '2022-06-30'];
		let msgAlerta = document.getElementById('msgAlerta');
		let quant_days = document.getElementById('qtd_dias').value;
		let types_of_days_corridos = document.getElementById('dias_corridos').checked;
		let types_of_days_uteis = document.getElementById('dias_uteis').checked;

		let number = document.getElementById('entrada_date').value;
		/*condição para obrigar o código a ser executado somente se nenhum dos campos de entrada estiverem vazios*/
		if (number != "" && quant_days != "") {
			var data = new Date(number + ' 00:00:00');
			if (data.getDay() == 0) {
				msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">A data inicial não pode ser no Domingo!</div>';
			} else if (data.getDay() == 6) {
				msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">A data inicial não pode ser no Sábado!</div>';
			} else if (feriado.includes(date_saida(data))) {
				msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Encontrado um feriado, favor selecionar outra quantidade de dias!</div>';
			}
			/*condição para exibir os resultados conforme seja escolhido a contagem em forma de dias corridos*/
			if (types_of_days_corridos) {
				/*utilizando a função parseInt para transformar a quantidade de dias em um numero inteiro*/
				let x = parseInt(quant_days);

				/*cáclulo para realizar a somatoria do dia atual com a quantidade de dias desejado*/
				data.setDate(data.getDate() + x);

				/*condições de aviso caso a contagem caia tanto em finais de semana quanto em feriados*/
				if (data.getDay() == 0) {
					msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Domingo, favor selecionar outra quantidade de dias!</div>';
				} else if (data.getDay() == 6) {
					msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Sábado, favor selecionar outra quantidade de dias!</div>';
				} else if (feriado.includes(date_saida(data))) {
					msgAlerta.innerHTML = '<div class="alert alert-danger" role="alert">Encontrado um feriado, favor selecionar outra quantidade de dias!</div>';
				}
			}

			/*condição para exibir os resultados conforme seja escolhido a contagem em forma de dias úteis*/
			if (types_of_days_uteis) {
				/*laço de repetição feito para evitar que os finais de semana e os feriados sejam incuidos na contagem dos dias*/
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
			/*funcionalidade para exibir a data após calculado a contagem de dias e exibida em seu formato padrão(yyyy-mm-dd)*/
			document.getElementById("data").value = date_saida(data);
		}
	}
	async function listarFeriados(){
		let feriado = await fetch("get_datas.php");
		return feriado;
	}
</script>
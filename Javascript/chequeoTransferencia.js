function chequeoTransferencia()
{
	const aliasDestino= document.getElementById("alias-destino");
	const monto= document.getElementById("monto");
	const cuentaOrigen= document.getElementById("cuenta-origen");
	const saldo= cuentaOrigen.value.split("- ")[1];
	var error= false;

	debugger

	if (!aliasDestino.value.length)
	{
		aliasDestino.className= "error-border";
		error= true;
	}else
	{
		aliasDestino.className= "blank-border";
	}

	if (monto.value > saldo)
	{
		//document.getElementById("error-saldo-insuficiente").style.display= "block";
		error= true;
	}else
	{
		//document.getElementById("error-saldo-insuficiente").style.display= "none";
	}

	if (monto.value <= 0)
	{
		//document.getElementById("error-monto-invalido").style.display= "block";
		error= true;
	}else
	{
		//document.getElementById("error-monto-invalido").style.display= "none";
	}

	if (error)
	{
		return false;
	}else
	{
		return true;
	}
}
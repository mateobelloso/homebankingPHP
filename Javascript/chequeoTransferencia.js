function chequeoTransferencia()
{
	var aliasDestino= document.getElementById("alias-destino");
	var monto= document.getElementById("monto");
	var cuentaOrigen= document.getElementById("cuenta-origen");
	var saldo= parseInt(cuentaOrigen.value.split("- ")[1]);
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

	
	if (monto.valueAsNumber > saldo)
	{
		document.getElementById("error-saldo-insuficiente").style.display= "block";
		error= true;
	}else
	{
		document.getElementById("error-saldo-insuficiente").style.display= "none";
	}

	if (monto.valueAsNumber <= 0)
	{
		document.getElementById("error-monto-invalido").style.display= "block";
		error= true;
	}else
	{
		document.getElementById("error-monto-invalido").style.display= "none";
	}

	if (error)
	{
		return false;
	}else
	{
		return true;
	}
}
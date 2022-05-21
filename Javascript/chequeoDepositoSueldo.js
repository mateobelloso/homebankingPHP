function chequeoDepositoSueldo()
{
	const monto= document.getElementById("monto");

	if(monto.value.length == 0)
	{
		monto.className= "error-border";
		return false;
	}else
	{
		monto.className= "blank-border";
	}

	if (monto.value <= 0) 
	{
		document.getElementById("error-monto-invalido").style.display= "block";
		return false;
	}else
	{
		document.getElementById("error-monto-invalido").style.display= "none";
		return true;
	}
}
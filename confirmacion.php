<?php

	include(dirname(__FILE__).'/conf.php');
	
	$referenceCode = $_REQUEST['reference_sale'];
	$txtValue = $_REQUEST['value'];
	$newValue = number_format($txtValue, 1, '.', '');
	$currency = $_REQUEST['currency'];
	$statePol = $_REQUEST['state_pol'];
	$sign = $_REQUEST['sign'];
	$estadoTxt = 'Firma no concuerda';

	$firma = "$ApiKey~$merchantId~$referenceCode~$newValue~$currency~$statePol";
	$firmaMd5 = md5($firma);


	// Si la firma concuerda
	if($firmaMd5 === $sign){
		
		switch ($statePol) {
		    case 4:
		        $estadoTxt = "Transacción aprobada";
		        break;
		    case 6:
		       	$estadoTxt = "Transacción rechazada";
		        break;
		    case 7:
		        $estadoTxt = "Transacción pendiente";
		        break;
		    case 104:
		        $estadoTxt = "Error";
		        break;
		    default:
		      	$estadoTxt=$_REQUEST['mensaje'];
		}


	}

	$msg  = "<b>Estado:</b> $estadoTxt <br>";
	$msg .= "<b>Apikey:</b>$ApiKey - <b>merchantId:</b>$merchantId - <b>referenceCode:</b>$referenceCode - <b>newValue:</b>$newValue - <b>currency:</b>$currency - <b>statePol:</b>$statePol";
	$msg .= "<b>Firma MD5:</b> $firmaMd5 <br>";
	$msg .= "<br><hr><br><b>REQUEST EN JSON<br>";
	$msg .= json_encode($_REQUEST);

	$headers  = 'MIME-Version: 1.0' . "\r\n"; // set mime version
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; // set content-type as html

	mail($confirmacionEmail, 'Formulario página web', $msg,$headers);

	echo "ok";
?>
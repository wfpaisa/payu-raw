<?php
	include(dirname(__FILE__).'/conf.php');

	$firma = "$ApiKey~$merchantId~$referenceCode~$amount~$currency";
	$firmaMd5 = md5($firma);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario demo</title>
</head>
<body>

	<form method="post" action="<?php echo $url; ?>">
	  <input name="merchantId"    	value="<?php echo $merchantId; ?>" ><br>
	  <input name="accountId"     	value="<?php echo $accountId; ?>" ><br>
	  <input name="description"   	value="<?php echo $description; ?>" ><br>
	  <input name="referenceCode" 	value="<?php echo $referenceCode; ?>" ><br>
	  <input name="amount"        	value="<?php echo $amount; ?>" ><br>
	  <input name="tax"           	value="<?php echo $tax; ?>" ><br>
	  <input name="taxReturnBase" 	value="<?php echo $taxReturnBase; ?>" ><br>
	  <input name="currency"      	value="<?php echo $currency; ?>" ><br>
	  <input name="signature"     	value="<?php echo $firmaMd5; ?>" ><br>
	  <input name="test"          	value="<?php echo $test; ?>" ><br>
	  <input name="buyerEmail"    	value="<?php echo $buyerEmail; ?>" ><br>
	  <input name="responseUrl"    	value="<?php echo $responseUrl; ?>" ><br>
	  <input name="confirmationUrl" value="<?php echo $confirmationUrl; ?>" ><br>

	  <input name="Submit" type="submit" value="Enviar" >
	</form>

</body>
</html>
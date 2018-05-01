<?php
	include(dirname(__FILE__).'/conf.php');

	$merchant_id = $_REQUEST['merchantId'];
	$referenceCode = $_REQUEST['referenceCode'];
	$TX_VALUE = $_REQUEST['TX_VALUE'];
	$New_value = number_format($TX_VALUE, 1, '.', '');
	$currency = $_REQUEST['currency'];
	$transactionState = $_REQUEST['transactionState'];
	$firma = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
	$firmaMd5 = md5($firma);
	$firma = $_REQUEST['signature'];
	$reference_pol = $_REQUEST['reference_pol'];
	$cus = $_REQUEST['cus'];
	$extra1 = $_REQUEST['description'];
	$pseBank = $_REQUEST['pseBank'];
	$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
	$transactionId = $_REQUEST['transactionId'];


	switch ($transactionState) {
	    case 4:
	        $estadoTx = "Transacción aprobada";
	        break;
	    case 6:
	       	$estadoTx = "Transacción rechazada";
	        break;
	    case 7:
	        $estadoTx = "Transacción pendiente";
	        break;
	    case 104:
	        $estadoTx = "Error";
	        break;
	    default:
	      	$estadoTx=$_REQUEST['mensaje'];
	}


	if (strtoupper($firma) == strtoupper($firmaMd5)) {
?>

	<h2>Resumen Transacción</h2>
	<ul>
		<li><b>Estado de la transaccion:</b> <?php echo $estadoTx; ?></li>
		<li><b>ID de la transaccion:</b> <?php echo $transactionId; ?></li>
		<li><b>Referencia de la venta:</b> <?php echo $reference_pol; ?></li>
		<li><b>Referencia de la transaccion:</b> <?php echo $referenceCode; ?></li>

<?php
	if($pseBank != null) {
?>

		<li><b>Cus:</b> <?php echo $cus; ?></li>
		<li><b>Banco:</b> <?php echo $pseBank; ?></li>

<?php
	}
?>

		<li><b>Valor total:</b> $<?php echo number_format($TX_VALUE); ?></li>
		<li><b>Moneda:</b> <?php echo $currency; ?></li>
		<li><b>Descripción:</b> <?php echo ($extra1); ?></li>
		<li><b>Entidad:</b> <?php echo ($lapPaymentMethod); ?></li>
	</ul>

<?php
	}else{
?>

	<h1>Error validando firma digital.</h1>

<?php
	}
?>
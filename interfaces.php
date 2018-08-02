<?php	
interface PaymentMethodInterface {
	public function acceptPayment($receipt);
}

class CashPaymentMethod implements PaymentMethodInterface
{
	public function acceptPayment($recept)
	{
		return "Accept payment";
	}
}

class Checkout
{
	public function beginProcess(Receipt $receipt, CashPaymentMethod $cashPaymentMethod)
	{
		$cashPaymentMethod = $cashPaymentMethod->acceptPayment();
	}
}
<?php

class MercadoPagoIPN extends HTMLPageBlank
{
	public static function get_url_pattern() {
		$url = ZPHP::get_config('mercadopago.ipn_url');
		return new URLPattern(preg_quote($url), 'MercadoPagoIPN', 'MercadoPagoIPN');
	}

	/*-------------------------------------------------------------*/

	protected static $_callbacks = array();

	public static function add_callback($function)
	{
		self::$_callbacks[] = $function;
	}

	/*-------------------------------------------------------------*/

	public function __construct()
	{
		parent::__construct();

		$id = null;
		$payment_id = null;

		$mp = MercadoPagoHelper::create_instance();

		// Get the payment and the corresponding merchant_order reported by the IPN.
		if($_GET["topic"] == 'payment'){
			$payment_info = $mp->get("/collections/notifications/" . $_GET["id"]);
			$merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"]);
			// Get the merchant_order reported by the IPN.
		} else if($_GET["topic"] == 'merchant_order'){
			$merchant_order_info = $mp->get("/merchant_orders/" . $_GET["id"]);
		}

		$vars = compact('payment_info', 'merchant_order_info');

		if ($merchant_order_info["status"] == 200) {
			// If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
			$paid_amount = 0;

			foreach ($merchant_order_info["response"]["payments"] as  $payment) {
				if ($payment['status'] == 'approved'){
					$paid_amount += $payment['transaction_amount'];
					$payment_id = $payment['id'];
				}
			}

			if($paid_amount >= $merchant_order_info["response"]["total_amount"] || true){
				if(count($merchant_order_info["response"]["shipments"]) > 0) { // The merchant_order has shipments
					if($merchant_order_info["response"]["shipments"][0]["status"] == "ready_to_ship"){
//						print_r("Totally paid. Print the label and release your item.");
					}
				} else { // The merchant_order don't has any shipments


					foreach($merchant_order_info["response"]['items'] as $item)
					{
						$id = $item['id'];
//						$ids[] = $id;
					}

				}
			} else {
				//print_r("Not paid yet. Do not release your item.");
			}
		}

		foreach(self::$_callbacks as $callback)
		{
			@ call_user_func($callback, $id, $payment_id);
		}
	}

}
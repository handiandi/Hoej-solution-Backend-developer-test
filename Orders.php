<?php

	/**
	 * 
	 */
	class Orders{
		
		var $orders;
		function __construct(){
			$this->orders = $this->fetchOrders();
		}

		public function getOrders(){
			return $this->orders;
		}

		private	function fetchOrders(){
			$service_url = 'https://hoej.dk/tests/api/orders/';
			$curl = curl_init($service_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$curl_response = curl_exec($curl);
			if ($curl_response === false) {
			    $info = curl_getinfo($curl);
			    curl_close($curl);
			    die('error occured during curl exec. Additioanl info: ' . var_export($info));
			} 

			curl_close($curl);
			$decoded = json_decode($curl_response, TRUE);
			if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
			    die('error occured: ' . $decoded->response->errormessage);
			}
			
			return $decoded['orders'];
		}


		public function getProductByName($target_product){
		 	$targets = array();
		 	foreach ($this->orders as $order) {
		 		foreach ($order['products'] as $product) {
		 			if (array_key_exists ('name' , $product )){
			 			if (strtolower($product['name']) == strtolower($target_product)) {
			 				array_push($targets, $order);
			 				break;
			 			}
		 			} 			
		 		}
		 	}
		 	return $targets;
 		}


 		public function findMaterialByName($target_material) {
		 	$targets = array();
		 	foreach ($this->orders as $order) {
		 		foreach ($order['products'] as $product) {
		 			if (array_key_exists ('parts' , $product )){
		 				foreach ($product['parts'] as $part) {
		 					if (array_key_exists ('materials' , $part)){
		 						foreach ($part['materials'] as $material) {
		 							if (strtolower($material['name']) == strtolower($target_material)) {
						 				array_push($targets, $order);
						 				break 3;
						 			}
		 						}
		 					}
		 				}
			 			
		 			} 			
		 		}
		 	}
		 	return $targets;
		 }



		 public function findProductsWithNoParts() {
		 	$targets = array();
		 	foreach ($this->orders as $order) {
		 		foreach ($order['products'] as $product) {
		 			if (!array_key_exists ('parts' , $product) || sizeof($product['parts']) == 0){
		 				array_push($targets, $order);
						break;
		 			}
		 		}
		 	}
		 	return $targets;
		 }

	}

?>
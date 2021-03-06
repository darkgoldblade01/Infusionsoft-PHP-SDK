<?php
/**
 * Created by PhpStorm.
 * User: BrianLogan
 * Date: 8/22/2017
 * Time: 7:44 PM
 */

namespace darkgoldblade01\Infusionsoft;

use Carbon\Carbon;

/**
 * Class Ecommerce
 *
 * All functions that ineteract with e-commerce
 * in Infusionsoft.
 *
 * @package darkgoldblade01\Infusionsoft
 *
 */

class Ecommerce extends Infusionsoft {

	/**
	 * Campaigns constructor.
	 *
	 * @param array $options
	 *
	 * @throws \Exception
	 *
	 */
	public function __construct( array $options = [] ) {
		parent::__construct( $options );
		if(!isset($this->options['access_token'])) {
			throw new \Exception('Access token must be set.');
		}
	}

	/**
	 *
	 * List Orders
	 *
	 * Get a list of all of the orders
	 * in Infusionsoft, paginated. The max
	 * is 1000 records per page. Offset is
	 * the number of records you want to skip
	 * at the beginning, for instance, if your
	 * limit is 100, and you have 200 orders,
	 * the offset for page 2 should be 100.
	 *
	 * @param string $since The start date of when you want to grab data.
	 * @param string $until The end date of when you want to grab data.
     * @param int $limit The max number of records you want returned at once, max is 1000, default is 1000.
     * @param string $offset The number of records you want to skip from the beginning.
     * @param bool $paid If you want only paid transactions, set to true. If you want unpaid, set to false, otherwise, leave null and return all.
     * @param string $order How you want them ordered, by ID, date, etc.
     * @param string $contactId The ID of a contact if you want to pull orders with that contact in them.
     * @param string $productId The ID of a product if you want to pull orders with that product in them.
	 *
     *
	 * @return mixed
	 */
	public function listOrders(string $since = null, string $until = null, $limit = 1000, string $offset = null, bool $paid = null, string $order = null, string $contactId = null, string $productId = null) {
		$query = [];
        if($since)
            $query['since'] = Carbon::parse($since)->toIso8601String();
        if($until)
            $query['until'] = Carbon::parse($until)->toIso8601String();
		if($limit)
			$query['limit'] = $limit;
		if($offset)
			$query['offset'] = $offset;
		if($paid)
			$query['paid'] = $paid;
		if($order)
			$query['order'] = $order;
		if($contactId)
			$query['contact_id'] = $contactId;
		if($productId)
			$query['product_id'] = $productId;

		$request = $this->send("GET", "orders", [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'query' => $query
		]);
		return $request;
	}

	/**
	 *
	 * Get Order
	 *
	 * Get a specific order
	 * from Infusionsoft, seeing more
	 * details than you would through
	 * the List Orders function.
	 *
	 * @param $orderId
	 *
	 * @return mixed
	 */
	public function getOrder($orderId) {
		$request = $this->send("GET", "orders/" . $orderId, [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
		]);
		return $request;
	}

	/**
	 *
	 * List Transactions
	 *
	 * Get a list of all of the transactions
	 * in Infusionsoft, paginated. The max
	 * is 1000 records per page. Offset is
	 * the number of records you want to skip
	 * at the beginning, for instance, if your
	 * limit is 100, and you have 200 transactions,
	 * the offset for page 2 should be 100.
     *
     * @param string $since The start date of when you want to grab data.
     * @param string $until The end date of when you want to grab data.
     * @param int $limit The max number of records you want returned at once, max is 1000, default is 1000.
     * @param string $offset The number of records you want to skip from the beginning.
     * @param string $contactId The ID of a contact if you want to pull transactions with that contact in them.
	 *
     *
	 * @return mixed
	 */
	public function listTransactions(string $since = null, string $until = null, $limit = 1000, string $offset = null, string $contactId = null) {
		$query = [];
		if($since)
			$query['since'] = $since;
		if($until)
			$query['until'] = $until;
		if($limit)
			$query['limit'] = $limit;
		if($offset)
			$query['offset'] = $offset;
		if($contactId)
			$query['contact_id'] = $contactId;

		$request = $this->send("GET", "transactions", [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'query' => $query
		]);
		return $request;
	}

	/**
	 *
	 * Get Transaction
	 *
	 * Get a specific transaction
	 * from Infusionsoft, seeing more
	 * details than you would through
	 * the List Transactions function.
	 *
	 * @param string $transactionId
	 *
	 * @return mixed
	 */
	public function getTransaction(string $transactionId) {
		$request = $this->send("GET", "transactions/" . $transactionId, [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
		]);
		return $request;
	}

	/**
	 *
	 * List Order Transactions
	 *
	 * Get a list of all of the transactions
	 * for a specific order from Infusionsoft,
	 * paginated. The max is 1000 records
	 * per page. Offset is the number of records
	 * you want to skip at the beginning,
	 * for instance, if your limit is 100, and
	 * you have 200 transactions, the offset
	 * for page 2 should be 100.
     *
     * @param string $orderId The ID of the order you want to pull transactions for.
     * @param string $since The start date of when you want to grab data.
     * @param string $until The end date of when you want to grab data.
     * @param int $limit The max number of records you want returned at once, max is 1000, default is 1000.
     * @param string $offset The number of records you want to skip from the beginning.
     * @param string $contactId The ID of a contact if you want to pull transactions with that contact in them.
	 *
	 * @return mixed
	 */
	public function listOrderTransactions(string $orderId, string $since = null, string $until = null, $limit = 1000, string $offset = null, string $contactId = null) {
		$query = [];
		if($since)
			$query['since'] = $since;
		if($until)
			$query['until'] = $until;
		if($limit)
			$query['limit'] = $limit;
		if($offset)
			$query['offset'] = $offset;
		if($contactId)
			$query['contact_id'] = $contactId;

		$request = $this->send("GET", "orders/" . $orderId . '/transactions', [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'query' => $query
		]);
		return $request;
	}
}
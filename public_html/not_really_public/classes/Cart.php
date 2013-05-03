<?php

class Cart
{
	protected $items = array(
		/*
		array(
			'productId' => 6,
			'quantity' => 2,
		)
		*/
	);

	public function __construct($data)
	{
		if (isset($data['items']) && is_array($data['items'])) {
			foreach ($data['items'] as $item) {
				$this->items[$item['productId']] = $item['quantity'];
			}
		}
	}

	public function add($productId)
	{
		if (!array_key_exists($productId, $this->items)) {
			$this->items[$productId] = 0;
		}

		$this->items[$productId]++;
	}

	public function remove($productId)
	{
		if (!array_key_exists($productId, $this->items)) {
			return;
		}

		if ($this->items[$productId] <= 1) {
			unset($this->items[$productId]);
			return;
		}

		$this->items[$productId]--;
	}

	public function clear()
	{
		$this->items = array();
	}

	public function toArray()
	{
		$items = array();
		$total = 0;
		foreach ($this->items as $productId => $quantity) {
			$item = array(
				'productId' => $productId,
				'quantity' => $quantity,
				'total' => $quantity * $this->getPrice($productId),
			);
			$total += $item['total'];
			$items[] = $item;
		}
		$data = array(
			'items' => $items,
			'total' => $total,
		);
		return $data;
	}

	protected function getPrice($productId)
	{
		$database = Registry::getDatabase();
		$products = $database->select('product', array('id' => $productId));
		$product = array_shift($products);
		return $product['price'];
	}
}

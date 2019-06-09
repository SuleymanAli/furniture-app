<?php

namespace App;

class WishList
{
	public $items;

	function __construct($oldCart)
	{
		if ($oldCart) {
			$this->items = $oldCart->items;
		}
	}

	public function add($item, $id)
	{
		$storedItem = [
			'item' => $item
		];

		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}

		$this->items[$id] = $storedItem;
	}

	public function removeItem($id)
	{
		unset($this->items[$id]);
	}
}

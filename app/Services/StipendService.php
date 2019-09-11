<?php

namespace App\Services;

use App\Models\Fgp\StipendItem;

class StipendService{

	/** @var $stipendItem StipendItem */
	protected $stipendItem;

	/** @var $items Array */
	protected $items = [

		"stipends"	=> "stipends"

	];

	public function __construct(StipendItem $stipendItem){

		$this->stipendItem = $stipendItem;

	}

	/**
	 * Fetch Stipends Amount
	 * @return Float stipends amount
	 */
	public function getStipendsAmount() : float{

		return $this->fetchStipendItemAmount($this->items['stipends']);		

	}

	/**
	 * Fetch stipend items amount 
	 * @param  string $itemCode item code of stipends_items
	 * @return Float amount           
	 */
	public function fetchStipendItemAmount(string $itemCode) : float{

		$stipend = $this->stipendItem->where('item_code', $itemCode)->first();

		return $stipend ? $stipend->unit_amount : 0;
		

	}

}
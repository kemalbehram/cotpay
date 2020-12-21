<?php
namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function countOrderByStatus($status, $sellBuy);
	
	public function getListOrder($sellBuy);
	public function getAllOrderByDate($start, $end, $sellBuy);
	// public function createOrder($attribute);
}

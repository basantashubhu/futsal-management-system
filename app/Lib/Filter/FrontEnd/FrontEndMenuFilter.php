<?php


namespace App\Lib\Filter\FrontEnd;

use App\Lib\Filter\AbstractFilter;

class FrontEndMenuFilter extends AbstractFilter
{
	public function menu_name($menu = false)
	{
		if ($menu) {
            return $this->builder->where('menu_name', 'LIKE', "%$menu%");
        }
        return $this->builder;
	}
}
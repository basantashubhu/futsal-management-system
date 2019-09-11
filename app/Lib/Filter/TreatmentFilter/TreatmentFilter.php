<?php


namespace App\Lib\Filter\TreatmentFilter;

use App\Lib\Filter\AbstractFilter;
use Illuminate\Http\Request;

class TreatmentFilter extends AbstractFilter
{
	public function treatment_name($name = false)
	{
		if($name){
			return $this->builder->where('treatment_name', 'LIKE', '%' . $name . '%');
		}
		return $this->builder;
	}
	public function name($name = false)
	{
		if($name){
			return $this->builder->where('rate_type.name', $name);
		}
		return $this->builder;
	}
	public function type($type = false)
	{
		if($type){
			return $this->builder->where('rates.animal_type', $type);
		}
		return $this->builder;
	}

}
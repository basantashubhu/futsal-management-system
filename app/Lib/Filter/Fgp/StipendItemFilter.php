<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class StipendItemFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $stipendTimeItem='';
        $stipendTimeItemCode='';
        $stipendTimeItemStatus = '';

        $stipendItemName = '';
        $stipendItemCode = '';
        $stipendItemStatus = '';

        if ($data):
            foreach ($data as $d):
                if ($d['name'] == 'stipendItemName'):
                    $stipendItemName = $d['value'];
                elseif ($d['name'] == 'stipendItemCode'):
                    $stipendItemCode = $d['value'];

                elseif ($d['name'] == 'stipendTimeItem'):
                    $stipendTimeItem = $d['value'];

                elseif ($d['name'] == 'stipendTimeItemCode'):
                    $stipendTimeItemCode = $d['value'];

                elseif($d['name'] == 'stipendItemStatus'):
                    $stipendItemStatus = $d['value'];

                elseif($d['name'] == 'stipendTimeItemStatus'):
                    $stipendTimeItemStatus = $d['value'];
                endif;
            endforeach;
        endif;

        if ($stipendTimeItem)
            $this->stipendTimeItem($stipendTimeItem);

        if ($stipendTimeItemCode)
            $this->stipendTimeItemCode($stipendTimeItemCode);

        if ($stipendItemName)
            $this->stipendItemName($stipendItemName);

        if ($stipendItemCode)
            $this->stipendItemCode($stipendItemCode);

        if ($stipendItemStatus)
            $this->stipendItemStatus($stipendItemStatus);

        if ($stipendTimeItemStatus)
            $this->stipendTimeItemStatus($stipendItemStatus);
    }



    public function stipendItemStatus($query = false){


            return $this->builder->where('category','!=','Type')->where('is_active',$query);

    }
    public function stipendTimeItemStatus($query = false){
            return $this->builder->where('category','Type')->where('is_active',$query);
    }
    public function stipendTimeItem($query = false)
    {
        if ($query) {
            return $this->builder->where('item_name', 'LIKE', "%$query%")->where('category','Type');
        }
        return $this->builder;
    }
    public function stipendTimeItemCode($query = false)
    {
        if ($query) {
            return $this->builder->where('item_header', 'LIKE', "%$query%")->where('category','Type');
        }
        return $this->builder;
    }
  public function stipendItemName($query = false)
    {
        if ($query) {
            return $this->builder->where('item_name', 'LIKE', "%$query%");
        }
        return $this->builder;
    }


    public function stipendItemCode($query = false)
    {
        if ($query) {
            return $this->builder->where('item_header', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
}
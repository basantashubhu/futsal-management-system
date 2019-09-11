<?php


namespace App\Lib\Filter;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class AbstractFilter
{
    protected $request;
    protected $builder;
    private $executedArr = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->executedArr = [];
    }

    public function getQuery($builder)
    {
        $this->builder = $builder;
        $data = $this->request->all();
                    // dd(array_key_exists('query', $data),  isset($data['query']), $this->request->all());
        if (array_key_exists('query', $data) && isset($data['query'])) {
            foreach ($data['query'] as $name => $value) {
                if (method_exists($this, $name)) {
                    if (!in_array($name, $this->executedArr)) {
                        if($value!="" && $value!=null)
                            array_push($this->executedArr, $name);
                        call_user_func_array([$this, $name], array_filter([$value]));
                    }
                }
            }
        }
        // dd($data['query']);
        return $this->builder;
    }

    public function getQueryNormal($builder)
    {
        $this->builder = $builder;
        foreach ($this->request->all() as $name => $value) {
            if (method_exists($this, $name)) {
                if (!in_array($name, $this->executedArr)) {
                    if($value!="" && $value!=null)
                        array_push($this->executedArr, $name);
                    call_user_func_array([$this, $name], array_filter([$value]));
                }
            }
        }
        return $this->builder;
    }

    public function getQueryCookie($builder, $data)
    {
        $this->builder = $builder;
        foreach ($data as $d) {
            $name=str_replace(']','',str_replace('[','',$d->name));
            if (method_exists($this, $name)) {
                if (!in_array($name, $this->executedArr)) {
                    if(isset($d->value)){
                        if($d->value!="" && $d->value!=null)
                            array_push($this->executedArr, $name);
                            call_user_func_array([$this, $name], [$d->value, $data]);
						}
					 }

            }
        }
        return $this->builder;
    }


}
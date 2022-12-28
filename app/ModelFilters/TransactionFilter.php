<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class TransactionFilter extends ModelFilter
{

    # _id is dropped from the end of the input key to define the method so filtering user_id would use the user() method
    protected $drop_id = false;
    protected $camel_cased_methods = false;
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function setup()
    {
        return;
    }

    public function transaction_date($filter)
    {
        return $this->whereDate('transaction_date', $filter);
    }

    public function transaction_amount($filter)
    {
        return $this->where('transaction_amount', $filter);
    }

    public function user_id($filter)
    {
        return $this->where('user_id', $filter);
    }

}

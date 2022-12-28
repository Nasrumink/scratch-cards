<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class ScratchCardFilter extends ModelFilter
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

    public function is_scratched($filter)
    {
        return $this->where('is_scratched', $filter);
    }

    public function is_active($filter)
    {
        return $this->where('is_active', $filter);
    }

    public function used_cards($filter)
    {
        $this->where('is_active', true);

        if ($filter)
            return $this->where('is_scratched', true);
        else
            return $this->where('is_scratched', false);
    }

}

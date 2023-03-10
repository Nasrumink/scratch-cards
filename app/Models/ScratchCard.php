<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\ModelFilters\ScratchCardFilter;
use EloquentFilter\Filterable;

class ScratchCard extends Model
{
    use Filterable;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
}

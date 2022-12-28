<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\ModelFilters\TransactionFilter;
use EloquentFilter\Filterable;

class Transaction extends Model
{
    use Filterable;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

}

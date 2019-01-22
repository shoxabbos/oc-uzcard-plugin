<?php namespace Shohabbos\Uzcard\Models;

use Model;

/**
 * Model
 */
class Transaction extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'shohabbos_uzcard_transactions';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}

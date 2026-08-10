<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\SyncsWithDirectory;
use NetworkRailBusinessSystems\DirectoryLink\Traits\UsesDirectory;

/**
 * @property string $azure_id
 * @property string $business_area
 * @property string $email
 * @property int $employee_number
 * @property string $first_name
 * @property string $last_name
 * @property string $location
 * @property string $name
 * @property string $phone
 * @property string $title
 */
class MyModel extends Model implements SyncsWithDirectory
{
    use UsesDirectory;

    protected $fillable = [
        'azure_id',
        'business_area',
        'email',
        'employee_number',
        'first_name',
        'last_name',
        'location',
        'name',
        'phone',
        'title',
    ];

    public $timestamps = false;

    protected $primaryKey = 'azure_id';

    protected $keyType = 'string';

    public $incrementing = false;
}

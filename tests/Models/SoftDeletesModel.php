<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDeletesModel extends MyModel
{
    use SoftDeletes;

    protected $table = 'my_models';
}

<?php

namespace App\Models;

use Framework\ORM\Model;

class User extends Model
{
    public $table = 'cex_user';

    public $primaryKey = 'id';
}

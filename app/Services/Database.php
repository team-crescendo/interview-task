<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface Database{
    public function export($models);
}

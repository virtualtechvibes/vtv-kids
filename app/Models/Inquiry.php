<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['parent_name', 'child_name', 'class', 'child_age', 'phone', 'interested_in', 'message'])]
class Inquiry extends Model {}

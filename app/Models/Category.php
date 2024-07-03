<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,StatusAttribute;
    protected $guarded = [];
}

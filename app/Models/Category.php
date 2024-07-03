<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use App\Helper\Mutator\SlugMutator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,StatusAttribute,SlugMutator;
    
    protected $guarded = [];
}

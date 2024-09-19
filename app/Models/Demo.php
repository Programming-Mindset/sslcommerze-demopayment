<?php

namespace App\Models;

use App\Models\Traits\ModifyBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demo extends Model
{
    use HasFactory, SoftDeletes, ModifyBy;

    protected $table = 'demos';

    protected $guarded = ['id'];
}

<?php

namespace App\Models;

use App\Models\Traits\ModifyBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestModel extends Model
{
    use HasFactory, SoftDeletes, ModifyBy;

    protected $table = 'test_models';

    protected $guarded = ['id'];
}

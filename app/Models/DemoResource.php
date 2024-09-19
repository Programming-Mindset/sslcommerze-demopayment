<?php

namespace App\Models;

use App\Models\Traits\ModifyBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemoResource extends Model
{
    use HasFactory, SoftDeletes, ModifyBy;

    protected $table = 'demo_resources';

    protected $guarded = ['id'];
}

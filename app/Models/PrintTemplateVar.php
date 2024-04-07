<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintTemplateVar extends Model
{
    use HasFactory;

    protected $table = 'print_template_var';

    protected $guarded = [
        'id'
    ];
}

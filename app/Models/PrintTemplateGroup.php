<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrintTemplateGroup extends Model
{
    use HasFactory;

    protected $table = "print_template_group";

    protected $guarded = [];

    public function printTemplateGroup(): BelongsTo{
        return $this->belongsTo(PrintTemplateGroup::class, 'parent');
    }
}

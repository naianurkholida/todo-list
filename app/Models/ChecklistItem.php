<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = ['item', 'checklist_id', 'status'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }
}
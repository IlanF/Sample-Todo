<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'completed_at'];
    protected $casts = ['completed_at' => 'datetime'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getTruncatedDescription($length = 40) {
        if(mb_strlen($this->description) > $length) {
            return mb_substr($this->description, 0, $length) . '…';
        }

        return $this->description;
    }
}

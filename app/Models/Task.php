<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Developer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'idT';
    protected $fillable = [
        'idP', 'idD', 'durationHours', 'priceHour','state'
    ];

    public function project() {
        return $this->belongsTo(Project::class, 'idP', 'idP');
    }

    public function developer() {
        return $this->belongsTo(Developer::class, 'idD', 'idD');
    }
}

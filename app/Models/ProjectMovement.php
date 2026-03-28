<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectMovement extends Model {
    protected $fillable = ['project_id', 'type', 'description'];
    public function project() { return $this->belongsTo(Project::class); }
}

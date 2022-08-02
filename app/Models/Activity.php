<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as SpatieActivity;


class Activity extends SpatieActivity
{
    use HasFactory;

    public function modelName(string $model): string
    {
        $modelArray = explode('\\', $model);

        return end($modelArray);
    }

    public function getLinkAttribute()
    {
        if($this->subject_type == 'App\Models\Lead') {
            return "<a href='".route('leads.edit', $this->subject_id)."'>$this->description</a>";
        }
        if($this->subject_type == 'App\Models\HlBorrower') {
            return "<a href='".route('hlBorrowers.edit', $this->subject_id)."'>$this->description</a>";
        }

        return $this->description;
    }
}

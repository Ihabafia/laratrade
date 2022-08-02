<?php

namespace App\Models;

use App\Enums\Communication as CommunicationEnum;
use App\Models\Scopes\ClientScope;
use App\Traits\AuditTrailable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Communication extends Model
{
    use HasFactory, LogsActivity, AuditTrailable;

    public $timestamps = false;
    protected $casts = [
//        'type' => CommunicationEnum::class,
        'variables' => 'array',
    ];

    public function getBodyStringAttribute()
    {
        return $this->attributes['body'];
    }

    /*public function body(): Attribute
    {
        return new Attribute(
            get: fn($value) => nl2br($value),
            set: null, //fn($value) => br2nl($value),
        );
    }*/
    public function getBodyBrAttribute()
    {
        return str(nl2br($this->attributes['body']))->replace("\r\n", '');
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setMethodAttribute($class)
    {
        $this->attributes['method'] = str($class)->camel()->__toString();
    }

    private function message($eventName)
    {
        return "The ".$this->className()." {$this->slug} has been {$eventName}";
    }

    public function master(): BelongsTo
    {
        return $this->belongsTo(MasterCommunication::class);
    }
}

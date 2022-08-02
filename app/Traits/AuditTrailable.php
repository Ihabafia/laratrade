<?php

namespace App\Traits;

use Illuminate\Support\Stringable;
use Spatie\Activitylog\LogOptions;
use Str;

trait AuditTrailable
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->useLogName(session('client_id') ?? 'API')
            ->setDescriptionForEvent(function (string $eventName) {
                return $this->message($eventName);
            });
    }

    private function className(): string
    {
        return str(class_basename($this))->kebab()->replace('-', ' ')->__toString();
    }

    private function message($eventName)
    {
        return "The ".$this->className()." {$this->id} has been {$eventName}";
    }
}

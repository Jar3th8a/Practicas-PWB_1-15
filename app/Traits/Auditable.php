<?php

namespace App\Traits;

use App\Models\Audit;

trait Auditable
{
    public static function bootAuditable(): void
    {
        static::created(function ($model): void {
            self::createAudit($model, 'create', null, $model->getAttributes());
        });

        static::updated(function ($model): void {
            $changes = $model->getChanges();
            unset($changes['updated_at']);

            if (empty($changes)) {
                return;
            }

            $oldValues = array_intersect_key($model->getOriginal(), $changes);
            self::createAudit($model, 'update', $oldValues, $changes);
        });

        static::deleted(function ($model): void {
            self::createAudit($model, 'delete', $model->getAttributes(), null);
        });
    }

    protected static function createAudit(object $model, string $action, ?array $oldValues, ?array $newValues): void
    {
        Audit::create([
            'user_name' => auth()->user()?->name ?? 'System',
            'model_type' => class_basename($model),
            'model_id' => $model->id,
            'action' => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
        ]);
    }
}

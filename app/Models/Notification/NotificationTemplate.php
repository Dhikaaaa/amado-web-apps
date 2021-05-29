<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Patient\Patient;
use Illuminate\Database\Eloquent\Relations\Pivot;

class NotificationTemplate extends Pivot
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'notification_templates';

    protected $fillable = [
        'title',
        'description',
        'topic',
        'image'
    ];

    /**
     * * Notification belongs to many Patient
     */
    public function users()
    {
        return $this->belongsToMany(Patient::class);
    }
}

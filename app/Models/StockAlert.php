<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockAlert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'alert_type',
        'title',
        'message',
        'current_stock',
        'threshold_stock',
        'status',
        'priority',
        'email_sent',
        'sms_sent',
        'push_sent'
    ];

    protected $casts = [
        'current_stock' => 'integer',
        'threshold_stock' => 'integer',
        'email_sent' => 'boolean',
        'sms_sent' => 'boolean',
        'push_sent' => 'boolean',
        'acknowledged_at' => 'datetime',
        'resolved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('alert_type', $type);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeLowStock($query)
    {
        return $query->where('alert_type', 'low_stock');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('alert_type', 'out_of_stock');
    }

    public function scopeCritical($query)
    {
        return $query->where('priority', 'critical');
    }

    // Helper methods
    public function acknowledge($userId = null)
    {
        $this->update([
            'status' => 'acknowledged',
            'user_id' => $userId ?? auth()->id(),
            'acknowledged_at' => now()
        ]);
    }

    public function resolve()
    {
        $this->update([
            'status' => 'resolved',
            'resolved_at' => now()
        ]);
    }

    public function dismiss()
    {
        $this->update([
            'status' => 'dismissed'
        ]);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isCritical()
    {
        return $this->priority === 'critical';
    }

    public function getAlertTypeLabel()
    {
        $labels = [
            'low_stock' => 'Low Stock',
            'out_of_stock' => 'Out of Stock',
            'overstock' => 'Overstock',
            'expiring_soon' => 'Expiring Soon',
            'custom' => 'Custom Alert'
        ];

        return $labels[$this->alert_type] ?? ucfirst(str_replace('_', ' ', $this->alert_type));
    }

    public function getPriorityColor()
    {
        $colors = [
            'low' => 'text-green-600',
            'medium' => 'text-yellow-600',
            'high' => 'text-orange-600',
            'critical' => 'text-red-600'
        ];

        return $colors[$this->priority] ?? 'text-gray-600';
    }
} 
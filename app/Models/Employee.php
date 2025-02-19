<?php

namespace App\Models;

use App\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model {
    use Commentable;

    protected $connection = 'db_staff';

    protected $with = ['sessions'];

    public function sessions(): HasMany {
        return $this->hasMany(Session::class, 'serviced_by');
    }

    public function getServicedTotalAttribute() {
        return $this->sessions->count();
    }

    public function getServicedMinutesTotalAttribute() {
        return $this->sessions->sum('time');
    }

    public function getServicedInADayAttribute() {
        return $this->sessions
            ->filter(function ($session) {
                return $session->created_at->isToday();
            })
            ->count();
    }

    public function getServicedMinutesInADayAttribute() {
        return $this->sessions
            ->filter(function ($session) {
                return $session->created_at->isToday();
            })
            ->sum('time');
    }

    public function getServicedInAWeekAttribute() {
        return $this->sessions
            ->filter(function ($session) {
                return $session->created_at->between(now()->startOfWeek(), now()->endOfWeek());
            })
            ->count();
    }

    public function getServicedMinutesInAWeekAttribute() {
        return $this->sessions
            ->filter(function ($session) {
                return $session->created_at->between(now()->startOfWeek(), now()->endOfWeek());
            })
            ->sum('time');
    }

    public function getServicedInAMonthAttribute() {
        return $this->sessions
            ->filter(function ($session) {
                return $session->created_at->month == now()->month;
            })
            ->count();
    }

    public function getServicedMinutesInAMonthAttribute() {
        return $this->sessions
            ->filter(function ($session) {
                return $session->created_at->month == now()->month;
            })
            ->sum('time');
    }

    public function getFullNameAttribute(): string {
        return "{$this->first_name} {$this->last_name}";
    }
}

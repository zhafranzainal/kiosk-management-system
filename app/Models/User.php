<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'mobile_no',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function kioskParticipant()
    {
        return $this->hasOne(KioskParticipant::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}

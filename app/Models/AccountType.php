<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    // Adicione este método
    protected static function newFactory()
    {
        return \Database\Factories\AccountTypeFactory::new();
    }
}

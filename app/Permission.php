<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'ident', 'description', 'active',
    ];
    protected $casts = [
        'active' => 'bool',
    ];

    public function roles() {
        return $this->belongsToMany(App\Models\Role::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'ident', 'description',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }
}

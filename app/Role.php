<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $table = 'roles';
    protected $fillable = [
        'name', 'ident', 'description', 'level',
    ];
    protected $casts = [
        'level' => 'int',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'role_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ImportUsers extends Model
{
    protected $table = 'import_users';
    public $timestamps = false;

    protected $attributes = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'age' => 0
    ];

    public function import(array $users): void {
        DB::statement('SET autocommit=0');
        DB::table($this->table)->upsert($users, ['first_name', 'last_name'], ['email', 'age']);
        DB::statement('COMMIT');
    }
}

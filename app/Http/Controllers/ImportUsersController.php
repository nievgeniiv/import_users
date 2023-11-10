<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportUsers;
use Illuminate\Support\Facades\Log;

class ImportUsersController extends Controller
{
    public function index() {
        $countAll = ImportUsers::count();
        return view('import_users', ['countAll' => $countAll]);
    } 
    
    public function save() {
        $model = new ImportUsers();
        $responseJson = file_get_contents('https://randomuser.me/api/?results=5000');
        $res = json_decode($responseJson, true);
        $users = [];
        $countUpdated = 0;
        foreach ($res['results'] as $user) {
            $itemJson = ImportUsers::where('last_name', '=', $user['name']['last'])->get();
            $item = json_decode($itemJson, true);
            if (isset($item[0]) && $item[0]['first_name'] === $user['name']['first']) {
                $countUpdated++;
                continue;
            }
            
            $users[] = [
                'first_name' => $user['name']['first'],
                'last_name' => $user['name']['last'],
                'email' => $user['email'],
                'age' => (int)$user['dob']['age'],
            ];
        }
        
        if (!empty($users)) { 
            $model->import($users);
        }
        
        $countAll = ImportUsers::count();
        $countCreated = count($res['results']) - $countUpdated;
        return response()->json([
            'countAll' => $countAll,
            'countCreated' => $countCreated,
            'countUpdated' => $countUpdated
        ]);
    }
}

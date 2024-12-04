<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;

class PermissionController extends Controller
{
    //
    public function updatePermission(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'permission' => 'required|string',
            'isChecked' => 'required|boolean',
        ]);
        $userId = $request->input('userId');
        $permission = $request->input('permission');
        $isChecked = $request->input('isChecked');

        $user = User::find($userId);
        $permission = Permission::where('name', $request->input('permission'))->first();
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($isChecked) {
            // Add the permission
            $user->permissions()->attach($permission);
        } else {
            // Remove the permission
            $user->permissions()->detach($permission);
        }

        return response()->json(['message' => 'Permission updated successfully.']);
    }

}
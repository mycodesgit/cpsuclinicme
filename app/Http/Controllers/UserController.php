<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\ClinicDB\User;

class UserController extends Controller
{
    public function userRead() {
        return view("user.list");
    }

    public function getusersRead() 
    {
        $data = User::all();
        return response()->json(['data' => $data]);
    }

    public function userCreate(Request $request) {
        $request->validate([
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $userEmail = $request->input('email'); 
        $existingUser = User::where('email', $userEmail)->first();

        if ($existingUser) {
            return response()->json(['error' => true, 'message' => 'User already exists'], 404);
        }

        try {
            User::create([
                'campus' => $request->input('campus'),
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'ext' => $request->input('ext'),
                'gender' => $request->input('gender'),
                'email' => $userEmail,
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'),
                'remember_token' => Str::random(64),
            ]);

            return response()->json(['success' => true, 'message' => 'User stored successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to store User'], 404);
        }
    }

    public function userUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        try {
            $userEmail = $request->input('email');
            $existingUser = User::where('email', $userEmail)->where('id', '!=', $request->input('id'))->first();

            if ($existingUser) {
                return response()->json(['error' => true, 'message' => 'User already exists'], 404);
            }

            $user = User::findOrFail($request->input('id'));
            $user->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'ext' => $request->input('ext'),
                'gender' => $request->input('gender'),
                'email' => $userEmail,
                'role' => $request->input('role'), 
            ]);

            //return redirect()->route('userEdit', ['id' => $user->id])->with('success', 'Updated Successfully');
            return response()->json(['success' => true, 'message' => 'User Updated Successfully'], 200);
        } catch (\Exception $e) {
            //return redirect()->back()->with('error', 'Failed to update User!');
            return response()->json(['error' => true, 'message' => 'Failed to update User'], 404);
        }
    }

    public function userPassUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        try {
            $userpass = User::findOrFail($request->input('id'));
            $userpass->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json(['success' => true, 'message' => 'User Password Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update User Password'], 404);
        }
    }

    public function userStatusUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        try {
            $stat = User::findOrFail($request->input('id'));
            $stat->update([
                'status' => $request->input('status'),
        ]);
            return response()->json(['success' => true, 'message' => 'User Status update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update User Status'], 404);
        }
    }
    
    public function userDelete($id){
        $user = User::find($id);
        if ($user) {
            $user->delete();
    
            return response()->json([
                'status' => 200,
                'uid' => $id,
            ]);
        }
    
        return response()->json([
            'status' => 404,
            'message' => 'User not found',
        ]);
    }

    public function appLogin(Request $request)
    {
        $credentials = $request->only('uname', 'pass');
        $uname = $credentials['uname'];
        $pass = $credentials['pass'];

        if (Auth::attempt(['username' => $uname, 'password' => $pass])) {
            $user = Auth::user();

            $token = ([
                'id' => $user->id,
                'fname' => $user->fname,
                'lname' => $user->lname
            ]);
    
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => '0'], 401);
    }
}

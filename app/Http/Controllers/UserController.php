<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index()
    {
        $users = User::latest()
        ->orderBy('id','desc')
        ->get(); 
        return view('users.index',compact('users'));
    }

    
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"    => "required|array",
            "name.*"  => "required",
            "birthday"    => "required|array",
            "birthday.*"  => "required",
            "email"    => "required|array",
            "email.*"  => "required",
            "password"    => "required|array",
            "password.*"  => "required|string|min:8",
            "password_confirmation"    => "required|array",
            "password_confirmation.*"  => "required|string|min:8",
        ]);
        if (!$validator->fails() && $request->password === $request->password_confirmation) {
            //estructura de filas para el insert
            $data = [];
            foreach ($request->name as $key => $value) {
                $data[$key]['name'] = $value;
            }
            foreach ($request->birthday as $key => $value) {
                $data[$key]['birthday'] = $value;
            }
            foreach ($request->email as $key => $value) {
                $data[$key]['email'] = $value;
            }
            foreach ($request->password as $key => $value) {
                $data[$key]['password'] = Hash::make($value);
            }

            User::insert($data); 
        }

        return redirect()->route('users.index');
    }

    
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        
        return redirect()->route('users.edit', $user);
    }


    public function updateName(Request $request, User $user)
    {
        $request->validate(['name'=>'required']);
        $user->update(['name' => $request->name]);
        
        return redirect()->route('users.show', $user);
    }

    public function updateBirthday(Request $request, User $user)
    {
        $request->validate(['birthday'=>'required']);
        $user->update(['birthday' => $request->birthday]);
        
        return redirect()->route('users.show', $user);
    }
    
    public function updateEmail(Request $request, User $user)
    {
        $request->validate(['email'=>'required|email|unique:users']);
        $user->update(['email' => $request->email]);
        
        return redirect()->route('users.show', $user);
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate(['password'=>'required|min:8']);
        $user->update(['password' => Hash::make($request->password)]);
        
        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}

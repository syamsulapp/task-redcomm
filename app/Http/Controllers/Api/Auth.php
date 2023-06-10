<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeleteTokenModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ], [
            'required' => ':attribute jangan di kosongkan',
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            if (auth()->attempt(['username' => $request->username, 'password' => $request->password])) {
                $result = $this->builder([
                    'user' => auth()->user(), //tampilkan data users after login success
                    'token' => auth()->user()->createToken('redcomm-api')->accessToken //ambil tokennya after login success
                ], 'Successfully Login');
            } else {
                $result = $this->builder('failed login', 'username atau password salah', 422);
            }
        }
        return $result;
    }

    public function register(Request $request)
    {
        $data = $request->all();

        //register(name, username, email dan password)
        $validator = Validator::make($data, [
            'username' => 'required|unique:users,username',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'required' => ':attribute jangan di kosongkan',
            'email' => 'penulisan tidak sesuai dengan format email',
            'unique' => ':attribute anda sudah terdaftar sebelumnya'
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            $data['password'] = Hash::make($request->password); //encrypt passwordnya
            $data['role_id'] = 2; //secara default setelah register jadi role user
            $result = $this->builder($this->user->create($data)); // submit semua data yang mau di register
        }
        return $result;
    }

    public function logout(Request $request)
    {
        DeleteTokenModel::whereuser_id($request->user()->id)->delete();
        return $this->builder($request->user(), 'Successfully Logout');
    }

    public function profile(Request $request)
    {
        return $this->builder($request->user());
    }

    public function updateProfile(Request $request)
    {
        //update all body profile users(langsung masukin body sedangkan id sudah otomatis by session)
        return $this->builder($this->user->where('id', $request->user()->id)->update($request->all()), 'Successfully update profile');
    }
}

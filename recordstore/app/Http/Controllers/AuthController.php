<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Registrera anv
    public function register(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                //unik mot email i userstabellen
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
            );

            //om det är nåt som är fel.
            if($validatedUser->fails()) {
                return response()->json([
                    'message' => 'Felaktiga uppgifter',
                    'error' => $validatedUser->errors()
                ], 401);
            }

            //om det är korrekt. spara användare o returnera token.
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
            ]);
            //redan när man registrerar så genereras token
            $token = $user->createToken('APITOKEN')->plainTextToken;
            //lagra i variabel
            $response = [
                'message' => 'Ny användare skapad',
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);
    }

    //logga in användare
    public function login(Request $request) {
    //validera
    $validatedUser = Validator::make(
        $request->all(),
        [
            //det som är required
            'email' => 'required|email',
            'password' => 'required'
        ]
        );

        //om det är nåt som är fel.
        if($validatedUser->fails()) {
            return response()->json([
                'message' => 'Fyll i alla fält ju',
                'error' => $validatedUser->errors()
            ], 401);
        }
        //felaktig loginuppgifter
        if(!auth()->attempt($request->only('email', 'password'))) {
            //om den returnerar false
            return response()->json([
                'message' => 'Felaktiga inloggningsuppgifter från API'
            ], 401);
        }

        //korrekta uppgifter, skicka tillbaks med token
        $user = User::where('email', $request->email)->first();
        //skapa token unik för denna användare
        return response()->json([
            'message' => 'användare inloggad',
            'token' => $user->createToken('APITOKEN')->plainTextToken
        ], 200);

    } 
    
    //logga ut användare
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        $response = [
            'message' => 'användare utloggad'
        ];

        return response($response, 200);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * Class AuthController.
 *
 * @author Neshia Hilton <taneshia.422024002@civitas.ukrida.ac.id>
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/user/register",
     *     tags={"user"},
     *     summary="Register new user & get token",
     *     operationId="register",
     *     @OA\Response(response=400, description="Invalid input", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successful", @OA\JsonContent()),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Register input",
     *         @OA\JsonContent(
     *             example={
     *                 "name": "Augusta Ada Byron",
     *                 "email": "ada.lovelace@gmail.com",
     *                 "password": "Ba88a935",
     *                 "password_confirmation": "Ba88a935"
     *             }
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $validated['password'] = Hash::make($validated['password']);
            $validated['remember_token'] = \Illuminate\Support\Str::random(10);

            $user = User::create($validated);
            $token = $user->createToken('<1st-name> REST API')->accessToken;

            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Registrasi gagal',
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     tags={"user"},
     *     summary="Log in to existing user & get token",
     *     operationId="login",
     *     @OA\Response(response=400, description="Invalid input", @OA\JsonContent()),
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Login input",
     *         @OA\JsonContent(
     *             example={
     *                 "email": "ada.lovelace@gmail.com",
     *                 "password": "Ba88a935"
     *             }
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        try {
            $user = User::where('email', $validated['email'])->first();

            if ($user && Hash::check($validated['password'], $user->password)) {
                $token = $user->createToken('<1st-name> REST API')->accessToken;

                return response()->json([
                    'email' => $user->email,
                    'token' => $token
                ], 200);
            }

            return response()->json([
                'message' => $user ? 'Password salah' : 'User tidak ditemukan'
            ], 400);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Login gagal',
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/user/logout",
     *     tags={"user"},
     *     summary="Log out & destroy self token",
     *     operationId="logout",
     *     @OA\Response(response=400, description="Invalid input", @OA\JsonContent()),
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
        public function logout(Request $request)
    {
        $user = Auth::user(); // ambil user dari token

        if ($user) {
            $user->token()->revoke(); // matikan token yang sedang aktif
            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
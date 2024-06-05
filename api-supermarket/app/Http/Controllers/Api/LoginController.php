<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     *
     * se a autenticação for bem-sucedida, retorna o usuario autenticado juntamente com um token de acesso. se a autenticação falhar, retorna uma msg de erro.
     *
     *
     * @param \Illuminate\Http\Request $request o objeto de requisição Http contendo as credenciais do usuario(email e password).
     * @return \Illuminate\Http\JsonResponse uma resposta json contendo o usuario autenticado e um token de acesso se a autenticação for bem sucessidida, ou uma msg de erro se a autenticação falhar.
     */
    public function login(Request $request): JsonResponse
    {
        // Validar o e-maile a senha
        if(Auth::attempt(['email' => $request->email, 'password' =>
        $request->password])){

            // Recuperar os dados do Usuário
            $user = Auth::user();

            // para gerar um token
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
            ], 201);

        }else {
            return response()->json([
                'status' => false,
                'messagem' => 'Login ou senha incorreta.',
            ], 404);
        }
    }

    /**
     *Realiza o logout do usuario.
     *
     * Este método revoga todos os tokens de acesso associados ao usuário:
     * Se o logout for bem-sucedida, retorna uma resposta JSON indicando suceso.
     * se ocorrer algum erro durante o logout, retorna uma resposta JSON indicando falha.
     *
     * @param \App\Models\User $user o usuário para o qual o logout será efectuado
     * @return \Illuminate\Http\JsonResponse A resposta JSON indicando o status do logout e uma mensagem correspondente.
     */
    public function logout(User $user): JsonResponse
    {
        try{

            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'messagem' => 'Deslogado com sucesso!.',
            ], 200);

        }catch (Exception $e){

            return response()->json([
                'status' => false,
                'messagem' => 'O usuário não deslogado.',
            ], 400);
        }
    }
}

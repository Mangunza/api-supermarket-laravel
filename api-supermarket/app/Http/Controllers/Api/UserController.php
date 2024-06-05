<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     *  Retornar uma lista paginada de usuários
     *
     *  Este método recupera uma lista paginada de usuários do banco de dados
     * e a retornar como uma resposta JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index() : JsonResponse
    {
        //Recupera os usuarios do BD, ordenados pelo id em ordem decrescente, paginados

       //$users = User::get(); // simples vizualização de um lista de usuarios
        //$users = User::orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->paginate(6); // permitir vizualizar até 6 entidades por pagina

        //Retorna os usuarios recuperados com uma resposta json
        return response()->json([
            'status' => true,
            'Usuarios' => $users,
        ], 200);
    }


    /**
     *  Exibe os detalhes de um usuário especifico
     *
     *  Este método  retorna os detalhes de um usuário especifico JSON
     *
     * @param \App\Models\User $user O objeto do usuário a ser exibido
     * @return \Illuminate\Http\JsonResponse
     */

    public function show(User $user) : JsonResponse
    {
        //Retorna os usuarios recuperados com uma resposta json
        return response()->json([
            'status' => true,
            'Usuario' => $user,
        ], 200);
    }


    /**
     * Criar novo usuário com os dados fornecidos na requisição.
     *
     *
     * @param \App\Http\Requests\UserRequest  $request o objeto de requisição contendo os dados do usuário a ser criado.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request) : JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            // Operação é concluida com êxito
            DB::commit();

            //Retorna os dados do usuário criado e uma mensagem de sucesso com status 201.
            return response()->json([
                'status' => true,
                'usuario' => $user,
                'message' => "usuario cadastrado com sucesso",
            ], 201);

        }catch (Exception $e){
            // A operação não é comcluida com éxito
            DB::rollBack();

            //Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "usuario não cadastrado com sucesso",
            ], 400);
        }
    }


    /**
     *  Atualizar os dados de um usuário existente com base nos dados fornecidos na requisição
     *
     *@param \App\Http\Requests\UserRequest $request o objeto da requisição contendo os dados do usuário a ser atualizado.
     * @param \App\Models\User $user O objeto do usuário a ser atualizado.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user) : JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        try{

            // Editar o registo no banco de dados
            $user->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> $request->password,
            ]);

            // Operação é concluida com êxito
            DB::commit();

            //Retorna os dados do usuário editado e uma mensagem de sucesso com status 200.
            return response()->json([
                'status' => true,
                'usuario' => $user,
                'message' => "usuario editado com sucesso",
            ], 200);

        }catch (Exception $e){
            // A operação não é concluida com éxito
            DB::rollBack();

            //Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "usuario não Editado com sucesso",
            ], 400);
        }
    }

    /**
     *  Excluir usuário no banco de dados
     *
     * @param \App\Models\User $user O objeto do usuário a ser excluido.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user) : JsonResponse
    {
        try{
            // Apagar o registro no banco de dados
            $user ->delete();

            //Retorna os dados do usuário apagado e uma mensagem de sucesso com status 200.
            return response()->json([
                'status' => true,
                'usuario' => $user,
                'message' => "usuario apagado com sucesso",
            ], 200);

        }catch(Exception $e){
            //Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "usuario não Editado com sucesso",
            ], 400);
        }
    }

}

<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Tw_rol;
use App\corporation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
       * @OA\Get(
       *     path="/users",
       *     operationId="Mostrar Todos los usuarios",
       *     tags={"Usuarios"},
       *     summary="Mostrar usuarios",
       *     @OA\Response(
       *         response=200,
       *         description="JSON con todos los usuarios en el indice data."
       *     ),
       *     @OA\Response(
       *         response="default",
       *         description="Ha ocurrido un error."
       *     )
       * )
       */
    public function index()
    {
      $users=User::All();
      return response(['data'=>$users],200);
    }

    /**
         * @OA\Post(
         *      path="/users",
         *      operationId="Crear un usuario",
         *      tags={"Usuarios"},
         *      summary="Crear un nuevo usuario",
         *      description="Crea un nuevo usuario",
         *@OA\Parameter(
         *          name="name",
         *          description="Nombre",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="email",
         *          description="Correo electrónico",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="password",
         *          description="Contraseña",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="password_confirmation",
         *          description="Confirmación de contraseña",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="tw_rol_id",
         *          description="Id del rol",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="integer"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="corporation_id",
         *          description="Id del corporativo",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="integer"
         *          )
         *      ),
         *      @OA\RequestBody(
         *          required=true,
         *
         *      ),
         *      @OA\Response(
         *          response=201,
         *          description="Agregado corretamente",
         *       ),
         *      @OA\Response(
         *          response=422,
         *          description="Error en la validaciones"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="Error en las llaves foraneas, id no existente"
         *      )
         * )
         */
    public function store(Request $request)
    {

      $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'tw_rol_id'=>'required|integer',
            'corporation_id'=>'required|integer',
        ];
        $this->validate($request,$rules);
        $corporativo=corporation::findOrFail($request->corporation_id);
        $corporativo=Tw_rol::findOrFail($request->tw_rol_id);
          $campos= $request->all();
          $campos['N_Activo']=1;
          $campos['D_UltimaSesion']=null;
          $user=User::create($campos);
          return response()->json(['data'=>$user],201);
    }
    /**
         * @OA\Get(
         *     path="/users/{id}",
         *     operationId="Mostrar un usuario en específico",
         *     tags={"Usuarios"},
         *     summary="Mostrar usuario",
         *    @OA\JsonContent(
         *       required={"id"},
         *       @OA\Property(property="id", type="integer", format="integer", example="1"),
         *    ),
         *     @OA\Response(
         *         response=200,
         *         description="JSON con todos los datos del usuario en el indice data.
         *          en el indice tw_rol contiene todo lo relacionado al rol del usuarios
         *          , el indice corporation contiene todo lo relacionado con el corporativo al que pertenece el usuario"
         *     ),
         *@OA\Parameter(
         *          name="id",
         *          description="Id del usuario",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="integer"
         *          )
         *      ),
         *     @OA\Response(
         *         response="default",
         *         description="Ha ocurrido un error."
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="No existe ningún usuario con ese ID"
         *     ),
         * )
         */
    public function show(User $user)
    {
        $rol=$user->Tw_rol;
        $corporativo=$user->corporation;
        return response()->json(['data'=>$user],200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

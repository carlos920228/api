<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Tw_rol;
use App\corporation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
  public $successStatus = 200;
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
      //$user = Auth::user();
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
         * @OA\RequestBody(
        *    required=true,
        *    description="Agregar usuario",
         *    @OA\JsonContent(
         *       required={"name,email,password,password_confirmation,tw_rol_id,corporation_id"},
         *       @OA\Property(property="name", type="string", format="string", example="Carlos Romero"),
         *       @OA\Property(property="email", type="string", format="string", example="micorreo@midominio.com"),
         *       @OA\Property(property="password", type="string", format="string", example="123456"),
         *       @OA\Property(property="password_confirmation", type="string", format="string", example="123456"),
         *       @OA\Property(property="tw_rol", type="integer", format="integer", example="1"),
         *       @OA\Property(property="corporation_id", type="integer", format="integer", example="1"),
         *    ),
         *    ),
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
          $campos=$request->bcrypt(password);
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
         * @OA\RequestBody(
        *    required=true,
        *    description="Identificador del usuario",
         *    @OA\JsonContent(
         *       required={"id"},
         *       @OA\Property(property="id", type="integer", format="integer", example="1"),
         *    ),
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
    /**
         * @OA\Post(
         *     path="/login",
         *     operationId="Iniciar sesión",
         *     tags={"OAUTH"},
         *     summary="Iniciar sesión",
         *     @OA\Response(
         *         response=200,
         *         description="JSON con todos los datos del usuario en el indice data.
         *          en el indice tw_rol contiene todo lo relacionado al rol del usuarios
         *          , el indice corporation contiene todo lo relacionado con el corporativo al que pertenece el usuario"
         *     ),
         *@OA\Parameter(
         *          name="email",
         *          description="Correo del usuario",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="password",
         *          description="contraseña",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *     @OA\Response(
         *         response="default",
         *         description="Ha ocurrido un error."
         *     ),
         *     @OA\Response(
         *         response=401,
         *         description="Error en datos de acceso"
         *     ),
         * )
         */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $rol=$user->Tw_rol;
            $corporativo=$user->corporation;
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['dat'] =$user;
            return response()->json(['success' => $success], $this-> successStatus);
          }else{
            return response()->json(['error'=>'Datos erroneos'], 401);
          }
    }

    public function details()
    {
      $user = Auth::user();
      $rol=$user->Tw_rol;
      $corporativo=$user->corporation;
      return response()->json(['data'=>$user],200);
    }
}

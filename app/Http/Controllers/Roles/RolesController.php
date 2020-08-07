<?php
namespace App\Http\Controllers\Roles;
use App\Tw_rol;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller
{
  /**
       * @OA\Get(
       *     path="/roles",
       *     operationId="Mostrar todos los roles",
       *     tags={"Roles"},
       *     summary="Mostrar roles",
       *     @OA\Response(
       *         response=200,
       *         description="JSON con todos los roles en el indice data."
       *     ),
       *     @OA\Response(
       *         response="default",
       *         description="Ha ocurrido un error."
       *     )
       * )
       */
    public function index()
    {
      $roles=Tw_rol::where('N_Activo', 1)->get();
      return response(['data'=>$roles],200);
    }
    /**
         * @OA\Post(
         *      path="/roles",
         *      operationId="Crear un nuevo rol",
         *      tags={"Roles"},
         *      summary="Crear un nuevo rol",
         *      description="Crea un nuevo rol",
         *@OA\Parameter(
         *          name="S_Nombre",
         *          description="Nombre",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="S_MenuBgColor",
         *          description="color del menu",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="S_MenuBgImageUrl",
         *          description="dirección de la imagen del menu",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
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
         *      )
         * )
         */
    public function store(Request $request)
    {
      $rules=[
        'S_Nombre'=>'required',
        'S_MenuBgColor'=>'required',
        'S_MenuBgImageUrl'=>'required',
      ];
      $this->validate($request,$rules);
      $data=$request->all();
      $data['N_Activo']=1;
      $rol=Tw_rol::create($data);
      return response()->json(['data'=>$rol],201);
    }

    /**
         * @OA\Get(
         *     path="/roles/{id}",
         *     operationId="Mostrar todos los roles",
         *     tags={"Roles"},
         *     summary="Mostrar un rol específico",
         *     @OA\Response(
         *         response=200,
         *         description="JSON con el rol en el indice data."
         *     ),
         * @OA\Response(
         *         response="404",
         *         description="No existe ningún registro de tw_rol con el id especificado"
         *     ),
         *     @OA\Response(
         *         response="default",
         *         description="Ha ocurrido un error."
         *     )
         * )
         */
    public function show($rol)
    {
      $roles=Tw_rol::findOrFail($rol);
      return response()->json(['data'=>$roles],200);
    }
    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }
}

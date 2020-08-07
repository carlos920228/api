<?php
namespace App\Http\Controllers\Corporativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\corporation;
/**
* @OA\Info(title="API SchoolCloud", version="1.0.0",
* title="Documentación API SchoolCloud",
* description="Aquí encontrarán la descripción de todos los servicios que contiene esta API",
     * @OA\Contact(
     *          email="cromero@dannyyesoft.mx"
     *      ),
     *      @OA\License(
     *          name="© Copyright 2018 DannyyeSoft",
     *          url="https://pyme.dannyyesoft.mx/"
     *      )
*)
*
* @OA\Server(url="http://schoolcloud.test")
*/
class CorporativoController extends Controller
{
  /**
       * @OA\Get(
       *     path="/corporativos",
       *     operationId="Mostrar los corporativos",
       *     tags={"Corporativo"},
       *     summary="Mostrar corporativos",
       *     @OA\Response(
       *         response=200,
       *         description="JSON con todos los corporativos en el indice data."
       *     ),
       *     @OA\Response(
       *         response="default",
       *         description="Ha ocurrido un error."
       *     )
       * )
       */
    public function index()
    {
        $corporativos=corporation::All();
        return response(['data'=>$corporativos],200);
    }
    /**
         * @OA\Post(
         *      path="/corporativos",
         *      operationId="Crear corporativo",
         *      tags={"Corporativo"},
         *      summary="Crear un nuevo corporativo",
         *      description="Crea un nuevo corporativo",
         *@OA\Parameter(
         *          name="Nombre",
         *          description="Nombre completo",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="email",
         *          description="correo electrónico",
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
          'name'=>'required',
          'email'=>'required|email|unique:corporations',
          'web'=>'required|url',
      ];
      $this->validate($request,$rules);
        $campos= $request->all();
        $corporativo=corporation::create($campos);
        return response()->json(['data'=>$corporativo],201);
    }
    /**
         * @OA\Get(
         *     path="/corporativos/{id}",
         *     operationId="Muestra un corporativo en específico",
         *     tags={"Corporativo"},
         *     summary="Mostrar un corporativo",
         *     @OA\Response(
         *         response=200,
         *         description="JSON con el corporativo en el indice data y el indice telephones, dentro de el están los teléfonos asociados a ese corporativo"
         *     ),
         *     @OA\Response(
         *         response="default",
         *         description="Ha ocurrido un error."
         *     )
         *    @OA\Response(
         *         response="404",
         *         description="No existe el corporativo solicitado."
         *     )
         * )
         */
    public function show(corporation $corporativo)
    {
        $telefonos=$corporativo->telephones;
        return response()->json(['data'=>$corporativo],200);
    }
    /**
         * @OA\Put(
         *      path="/corporativos/{id}",
         *      operationId="Actualizar un corporativos",
         *      tags={"Corporativo"},
         *      summary="Actualizar un corporativo",
         *      description="Actualizar un corporativo",
         *@OA\Parameter(
         *          name="Nombre",
         *          description="Nombre completo",
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="email",
         *          description="correo electrónico",
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
         *          response=200,
         *          description="Actualizado corretamente",
         *       ),
         *      @OA\Response(
         *          response=422,
         *          description="Error en la validaciones"
         *      )
         *      @OA\Response(
         *          response=404,
         *          description="Corporativo no encontrado"
         *      )
         * )
         */
    public function update(Request $request, corporation $corporativo)
    {

      $rules=[
            'email'=>'email|unique:corporations,email,'. $corporativo->id,
            'web'=>'url',
        ];
        $this->validate($request,$rules);
        $corporativo->name=$request->name;
        $corporativo->email=$request->email;
        $corporativo->web=$request->web;
        $corporativo->save();
        return response()->json(['data'=>$corporativo],200);
    }
    /**
         * @OA\Delete(
         *     path="/corporativos",
         *     operationId="Borrar un corporativo en específico",
         *     tags={"Corporativo"},
         *     summary="Borrar un corporativo",
         *     @OA\Response(
         *         response=200,
         *         description="JSON con el corporativo en el indice data."
         *     ),
         *     @OA\Response(
         *         response="default",
         *         description="Ha ocurrido un error."
         *     )
         *    @OA\Response(
         *         response="404",
         *         description="No existe el corporativo solicitado."
         *     )
         * )
         */
    public function destroy(corporation $corporativo)
    {

      $corporativo->delete();
      return response()->json(['data'=>$corporativo],200);

    }
}

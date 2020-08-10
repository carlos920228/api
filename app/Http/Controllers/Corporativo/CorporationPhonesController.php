<?php

namespace App\Http\Controllers\Corporativo;
use App\corporation;
use App\corporation_phones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CorporationPhonesController extends Controller
{
  /**
       * @OA\Get(
       *     path="/corporativosPhone",
       *     operationId="Mostrar los corporativos",
       *     tags={"CorporativoPhone"},
       *     summary="Mostrar corporativos",
       *     @OA\Response(
       *         response=200,
       *         description="JSON con todos los teléfonos en el indice data."
       *     ),
       *     @OA\Response(
       *         response="default",
       *         description="Ha ocurrido un error."
       *     )
       * )
       */
    public function index(){
      $phones=corporation_phones::All();
      return response(['data'=>$phones],200);
    }
    /**
         * @OA\Get(
         *     path="/corporativosPhone/{id}",
         *     operationId="Mostrar telefono",
         *     tags={"CorporativoPhone"},
         *     summary="Mostrar un telefono específico",
         *     @OA\Response(
         *         response=200,
         *         description="JSON con el teléfono en el indice data."
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
    public function show($tel)
    {
      $telefono=corporation_phones::findOrFail($tel);
      $corporativo=$telefono->corporation;
      return response()->json(['data'=>$telefono],200);
    }
    /**
         * @OA\Post(
         *      path="/corporativosPhone",
         *      operationId="Agregar un teléfono a un corporativo",
         *      tags={"CorporativoPhone"},
         *      summary="Crear un nuevo teléfono para un corporativo",
         *      description="Crea un nuevo teléfono para un corporativo",
         *@OA\Parameter(
         *          name="Number",
         *          description="Número de telefono de 12 dígitos",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="integer"
         *          )
         *      ),
         **@OA\Parameter(
         *          name="S_Tipo",
         *          description="tipo de teléfono",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="corporation_id",
         *          description="Identificador del corporativo al que se va a asociar el número",
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
         *          description="No existe el id del corporativo especificado"
         *      )
         * )
         */

    public function store(Request $request)
    {
        $rules=[
          'number'=>'required|min:12',
          'corporation_id'=>'required|integer',
          'S_Tipo'=>'required',
        ];
        $this->validate($request,$rules);
        $data=$request->all();
        $corporativo=corporation::findOrFail($request->corporation_id);
        $phone=corporation_phones::create($data);
        return response()->json(['data'=>$phone],201);
    }
    /**
         * @OA\Put(
         *      path="/corporativosPhone/{id}",
         *      operationId="Actualizar el número de un corporativo",
         *      tags={"CorporativoPhone"},
         *      summary="Actualizar el número de corporativo",
         *      description="Actualizar un corporativo, recibe el id del teléfono a modificar",
         *@OA\Parameter(
         *          name="Number",
         *          description="Número de teléfono",
         *          in="path",
         *          @OA\Schema(
         *              type="integer"
         *          )
         *      ),
         *@OA\Parameter(
         *          name="S_tipo",
         *          description="Tipo de teléfono",
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         **@OA\Parameter(
         *          name="corporation_id",
         *          description="Corporativo asociado a ese teléfono",
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
         *          response=200,
         *          description="Actualizado corretamente",
         *       ),
         *      @OA\Response(
         *          response=422,
         *          description="Error en la validaciones"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="teléfono no encontrado"
         *      )
         * )
         */
    public function update(Request $request, $telefono)
    {
      $rules=[
        'number'=>'required|min:12',
        'S_Tipo'=>'required',
        'corporation_id'=>'required',
      ];

      $this->validate($request,$rules);
      $corporativo=corporation::findOrFail($request->corporation_id);
      $tel=corporation_phones::findOrFail($telefono);
      $tel->number=$request->number;
      $tel->S_Tipo=$request->S_Tipo;
      $tel->corporation_id=$request->corporation_id;
      $tel->save();
      return response()->json(['data'=>$tel],200);
    }
    /**
         * @OA\Delete(
         *     path="/corporativosPhone/{id}",
         *     operationId="Borrar un teléfono en específico",
         *     tags={"CorporativoPhone"},
         *     summary="Borrar un teléfono",
         *     @OA\Response(
         *         response=200,
         *         description="JSON con el teléfono en el indice data."
         *     ),
         *     @OA\Response(
         *         response="default",
         *         description="Ha ocurrido un error."
         *     ),
         *    @OA\Response(
         *         response="404",
         *         description="No existe el teléfono solicitado."
         *     ),
         * )
         */
    public function destroy($telefono)
    {
      $tel=corporation_phones::findOrFail($telefono);
      $tel->delete();
      return response()->json(['data'=>$tel],200);
    }

}

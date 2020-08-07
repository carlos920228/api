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
      $roles=Tw_rol::where('N_Activo', 1)->get();
      return response(['data'=>$roles],200);
    }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rol)
    {
      $roles=Tw_rol::findOrFail($rol);
      return response()->json(['data'=>$roles],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

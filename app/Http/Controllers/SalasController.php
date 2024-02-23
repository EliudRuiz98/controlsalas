<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; //carga errores en SQL.

class SalasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $salas= sala::all();
        /*cargar vista: llamar a la carpeta layout, archivo salas.blade.php*/
        return view('layout.salas',['salas'=>$salas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         /*cargar vista: llamar a la carpeta salas, archivo create.blade.php*/
        return view('salas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'numeroDeSalaComputo'=>'required|max:10',
            'nombreSalaComputo'=>'required|max:150',
            'ubicacionCentroComputo'=>'required|max:150',
            'descripcionCentroComputo'=>'required|max:150',
            'fechaDeAgregadoComputo'=>'required'

        ]);

        $salas = new Sala();
        $salas->numeroDeSalaComputo =$request->input('numeroDeSalaComputo');
        $salas->nombreSalaComputo =$request->input('nombreSalaComputo');
        $salas->ubicacionCentroComputo =$request->input('ubicacionCentroComputo');
        $salas->descripcionCentroComputo =$request->input('descripcionCentroComputo');
        $salas->estadoOcupado =$request->input('estadoOcupado');
        $salas->fechaDeAgregadoComputo =$request->input('fechaDeAgregadoComputo');
        $salas->save();

        return view("salas.message", ['msg'=>"registro guardado"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Sala $sala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function edit($idSala)
    {

    
            $sala = Sala::find($idSala);
            return view('salas.edit', ['sala' => $sala]);
    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idSala)
    {
        
        $request->validate([
            'numeroDeSalaComputo'=>'required|max:10',
            'nombreSalaComputo'=>'required|max:150',
            'ubicacionCentroComputo'=>'required|max:150',
            'descripcionCentroComputo'=>'required|max:150',
            'fechaDeAgregadoComputo'=>'required'

        ]);

        $salas = Sala::find($idSala);
        $salas->numeroDeSalaComputo =$request->input('numeroDeSalaComputo');
        $salas->nombreSalaComputo =$request->input('nombreSalaComputo');
        $salas->ubicacionCentroComputo =$request->input('ubicacionCentroComputo');
        $salas->descripcionCentroComputo =$request->input('descripcionCentroComputo');
        $salas->estadoOcupado =$request->input('estadoOcupado');
        $salas->fechaDeAgregadoComputo =$request->input('fechaDeAgregadoComputo');
        $salas->save();

        return view("salas.message", ['msg'=>"registro guardado"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSala)
{
    try {
        $salas = Sala::find($idSala);
        $salas->delete();
        
        return redirect("salas")->with('success', 'Centro de cómputo eliminado exitosamente');
    } catch (QueryException $e) {
        // Verifica si la excepción es por violación de restricción de clave externa
        if ($e->getCode() == 23000) {
            return redirect("salas")->with('error', 'No fue posible eliminar el centro de cómputo. Verifique que no existan reservas activas.');
        }

        // En caso de otras excepciones.
        return redirect("salas")->with('error', 'Error desconocido al intentar eliminar el centro de cómputo.');
    }
}
}

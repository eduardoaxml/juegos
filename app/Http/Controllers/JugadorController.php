<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Jugador;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jugadores=Jugador::orderBy('id','DESC')->paginate();
        return view('Jugador.index',compact('jugadores')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Jugador.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $jugador=new jugador;
        $jugador->nombre=$request->get('nombre');
        $jugador->clase=$request->get('clase');
        $jugador->nivel=$request->get('nivel');
        //subir imagen
        if(Input::hasFile('foto')){
            $file =  Input::file('foto');
            $file->move(public_path().'/uploads', $file->getClientOriginalName());
            $jugador->foto=$file->getClientOriginalName();
        }
        else{
            $jugador->foto='noimage.jpg'; 
        }
        $jugador->save();
        return redirect()->route('jugador.index')->with('success','Registro creado satisfactoriamente');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jugador=jugador::find($id);
        return  view('Jugador.show',compact('jugador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jugador=jugador::find($id);
        return view('Jugador.edit',compact('jugador'));

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
        $jugador=jugador::findOrFail($id);
        $jugador->nombre=$request->get('nombre');
        $jugador->clase=$request->get('clase');
        $jugador->nivel=$request->get('nivel');
        if(Input::hasFile('foto')){
            $file =  Input::file('foto');
            $file->move(public_path().'/upload', $file->getClientOriginalName());
            $jugador->foto=$file->getClientOriginalName();
        }
        $jugador->update();
        return redirect()->route('jugador.index')->with('success','Registro actualizado satisfactoriamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jugador::find($id)->delete();
        return redirect()->route('jugador.index')->with('success','Registro eliminado satisfactoriamente');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Jugador::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Jugadores eliminados correctamente."]);
        
    }
}

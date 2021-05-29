<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{

    public function index(){
        /*//retornar solo favorites de usuario
        return view('favorites.index',[
            'favorites' => Auth::user()->favorites
        ]);
        */
        $favorites = Favorite::latest()
        ->orderBy('id','desc')
        ->get(); 
        return view('favorites.index', compact('favorites'));
    }

    public function create()
    {
        return view('favorites.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"    => "required|array",
            "name.*"  => "required",
            "url"    => "required|array",
            "url.*"  => "required",
            //descomentar si permite asignar favoritos entre usuarios
            //"users"    => "required|array",
            //"users.*"  => "required",
        ]);
        if (!$validator->fails()) {
            //estructura de filas para el insert
            $data = [];
            foreach ($request->name as $key => $value) {
                $data[$key]['name'] = $value;
            }
            foreach ($request->url as $key => $value) {
                $data[$key]['url'] = $value;
                $data[$key]['user_id'] = Auth::user()->id;
            }
            //descomentar si permite asignar favoritos entre usuarios
            //foreach ($request->users as $key => $value) {
                //$data[$key]['user_id'] = $value;
            //}
            //estructura de filas para el insert

            Favorite::insert($data); 
        }

        return redirect()->route('favorites.index');
    }

    
    public function show(Favorite $favorite)
    {
        $this->authorize('pass',$favorite);
        return view('favorites.show',compact('favorite'));
    }

    
    public function edit(Favorite $favorite)
    {
        $this->authorize('pass',$favorite);
        return view('favorites.edit', compact('favorite'));
    }

   
    public function update(FavoriteRequest $request, Favorite $favorite)
    {
        $this->authorize('pass',$favorite);
        $favorite->update($request->all());
        return redirect()->route('favorites.edit', $favorite);
    }

    public function updateName(Request $request, Favorite $favorite)
    {
        $this->authorize('pass',$favorite);
        $request->validate(['name'=>'required']);
        $favorite->update(['name' => $request->name]);
        return redirect()->route('favorites.show', $favorite);
    }

    public function updateUrl(Request $request, Favorite $favorite)
    {
        $this->authorize('pass',$favorite);
        $request->validate(['url'=>'required']);
        $favorite->update(['url' => $request->url]);
        return redirect()->route('favorites.show', $favorite);
    }

    
    public function destroy(Favorite $favorite)
    {
        $this->authorize('pass',$favorite);
        $favorite->delete();
        return redirect()->route('favorites.index');
    }
}

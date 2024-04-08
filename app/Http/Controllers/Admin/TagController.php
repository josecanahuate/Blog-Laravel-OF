<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only(['index']);
        $this->middleware('can:admin.tags.create')->only(['create', 'store']);
        $this->middleware('can:admin.tags.edit')->only(['edit', 'update']);
        $this->middleware('can:admin.tags.destroy')->only(['destroy']);
    }

    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = [
            'red' => 'Color Rojo',
            'green' => 'Color Verde',
            'blue' => 'Color Azul',
            'yellow' => 'Color Amarillo',
            'gray' => 'Color Gris',
            'black' => 'Color Negro',
            'indigo' => 'Color Indigo',
            'purple' => 'Color Morado',
            'pink' => 'Color Rosado',
        ];

        return view('admin.tags.create', compact('colors'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>  'required|unique:tags',
            'slug' =>  'required|unique:tags',
            'color' => 'required'
        ]);

        //asignacion masiva + Modelo
        $tag = Tag::create($request->all());
        return redirect()->route('admin.tags.index', compact('tag'))->with('info', 'La etiqueta se ha creado con exito!');
    }

    public function edit(Tag $tag)
    {
        $colors = [
            'red' => 'Color Rojo',
            'green' => 'Color Verde',
            'blue' => 'Color Azul',
            'yellow' => 'Color Amarillo',
            'gray' => 'Color Gris',
            'black' => 'Color Negro',
            'indigo' => 'Color Indigo',
            'purple' => 'Color Morado',
            'pink' => 'Color Rosado',
        ];

        return view('admin.tags.edit', compact('tag', 'colors'));

    }


    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' =>  "required|unique:tags,name,$tag->id",
            'slug' =>  "required|unique:tags,slug,$tag->id",
            'color' => 'required'
        ]);

        $tag->update($request->all());
        return redirect()->route('admin.tags.edit', $tag)->with('info', 'La etiqueta se actualizo con exito!' );

    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index', $tag)->with('info', 'La etiqueta se ha eliminado con exito!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMemeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Memes - Memecultor";
        $viewData["memes"] = Meme::all();
        return view('admin.meme.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imgplantilla' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imgejemplo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('imgplantilla')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "plantilla." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['imgplantilla'] = "$profileImage";
        }

        if ($image2 = $request->file('imgejemplo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "ejemplo." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $profileImage);
            $input['imgejemplo'] = "$profileImage";
        }

        Meme::create($input);
        return back();
    }

    public function delete($id)
    {
        Meme::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit Meme - Online Store";
        $viewData["meme"] = Meme::findOrFail($id);
        return view('admin.meme.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        //Meme::validate($request);

        $meme = Meme::findOrFail($id);
        if(!is_null($request->input('nombre')))
            $meme->setNombre($request->input('nombre'));
        if(!is_null($request->input('descripcion')))
            $meme->setDescripcion($request->input('descripcion'));
        if(!is_null($request->input('imgplantilla'))){
            $meme->setImgPlantilla($request->input('imgplantilla'));

            if ($image = $request->file('imgplantilla')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "plantilla." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['imgplantilla'] = "$profileImage";
            }
        }
        if(!is_null($request->input('imgplantilla'))){
            $meme->setImgEjemplo($request->input('imgejemplo'));

            if ($image2 = $request->file('imgejemplo')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "ejemplo." . $image2->getClientOriginalExtension();
                $image2->move($destinationPath, $profileImage);
                $input['imgejemplo'] = "$profileImage";
            }
        }

        $meme->save();
        return redirect()->route('admin.meme.index');
    }
}

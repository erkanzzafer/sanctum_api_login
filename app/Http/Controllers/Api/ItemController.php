<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->isim=$request->isim;
        $item->aciklama=$request->aciklama;
        $item->adet=$request->adet;
        $saved=$item->save();
        if ($saved){
            return response()->json(['mesaj'=>'Ürün kaydedildi']);
        }else{
            return response()->json(['mesaj'=>'Kayıt başarısız']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=Item::find($id);
        if($item){
            return $item;
        }else{
            return response()->json(['mesaj'=>'ürün bulunamadı']);
        }
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
        $item=Item::findOrFail($request->id);
        $item->isim=$request->isim;
        $item->aciklama=$request->aciklama;
        $item->adet=$request->adet;
        $saved=$item->save();
        if ($saved){
            return response()->json(['mesaj'=>'güncelleme başarılı']);
        }else{
            return response()->json(['mesaj'=>'güncellenemedi']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::destroy($id);
        return response()->json(['mesaj'=>'silme başarılı']);
    }
}

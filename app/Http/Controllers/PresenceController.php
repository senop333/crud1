<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence; 
use Illuminate\Support\Str;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::all();
        return view('pages.presence.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.presence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'waktu_mulai' => 'required'
        ]);

        //dd($request->all());
        $data =[
            'nama_kegiatan' => $request->nama_kegiatan,
            'slug' => Str::slug($request->nama_kegiatan),
            'tgl_kegiatan' => $request->tgl_kegiatan.' '.$request->waktu_mulai,
        ];
        
        //dd($data);

        Presence::create($data);
        return redirect()->route('presence.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presence = Presence::findOrFail($id);
        return view('pages.presence.edit', compact('presence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // dd($request->all());
               $request -> validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'waktu_mulai' => 'required'
        ]);

        //dd($request->all());
       $presence = Presence::findorFail($id);

        
        $presence -> nama_kegiatan = $request->nama_kegiatan;
        $presence -> slug = Str::slug($request->nama_kegiatan);
        $presence -> tgl_kegiatan = $request->tgl_kegiatan.' '.$request->waktu_mulai;
        
        $presence->save();
        //dd($data);

        
        return redirect()->route('presence.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Presence::destroy($id);
        return redirect()->route('presence.index')->with('success', 'Data berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\PresenceDetail;



class PresenceDetailController extends Controller
{
   
    public function destroy($id)
    {
        $presenceDetail = PresenceDetail::findOrFail($id);
        $presenceDetail->delete();

 

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestroySession extends Controller
{
    // detroy session
    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

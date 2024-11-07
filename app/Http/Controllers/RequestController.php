<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

class RequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
	$name = $request->input('name', 'Indro Adi');
	return redirect('/nama')->with('nama', $name);
    }
}

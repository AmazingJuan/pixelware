<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AlliedProductController extends Controller
{
    public function index(): View
    {
        $response = Http::get('https://arslonga.sytes.net/api/artwork/list');

        if ($response->successful()) {
            $data = $response->json()['data'];
        } else {
            $data = [];
        }

        return view('user.allied.index', ['products' => $data]);
    }
}

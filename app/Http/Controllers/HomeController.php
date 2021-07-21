<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Module\FileDatabase\App\Database\Manager;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Manager $db)
    {
        $db->db('todo')->save([
            'a' => '1',
            'b' => '2',
        ]);

        return view('home');
    }
}

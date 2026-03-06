<?php

namespace App\Http\Controllers;

use App\Models\Producer;

class ProducerController extends Controller {
    public function index() {
        $producers = Producer::with('user')->get();
        return view('producers.index', compact('producers'));
    }
}
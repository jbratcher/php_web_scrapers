<?php

namespace App\Http\Controllers;
use App\Frame;

use Illuminate\Http\Request;

class FramesController extends Controller
{
    public function index()
    {
        return Frame::all();
    }
}

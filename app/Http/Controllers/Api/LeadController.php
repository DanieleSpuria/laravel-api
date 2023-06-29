<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
  public function store(Request $request) {
    $data = $request->all();
    $new_lead = Lead::create($data);
    return response()->json($data);
  }
}

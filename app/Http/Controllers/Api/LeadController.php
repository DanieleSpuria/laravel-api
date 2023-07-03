<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\newContact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
  public function store(Request $request) {
    $data = $request->all();

    $validator = Validator::make($data,
      [
        'name' => 'required',
        'email' => 'required|email',
        'text' => 'required',
      ],
      [
        'name.required' => 'Campo obbligatorio',
        'email.required' => 'Campo obbligatorio',
        'email.email' => 'Indirizzo non corretto',
        'text.required' => 'Campo obbligatorio',
      ]);

    if ($validator->fails()) {
      $success = false;
      $errors = $validator->errors();
      return response()->json(compact('success', 'errors'));
    }

    $new_lead = Lead::create($data);
    Mail::to('hello@example.com')->send(new newContact($new_lead));

    $success = true;
    return response()->json('success');
  }
}

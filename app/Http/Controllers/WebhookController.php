<?php

namespace App\Http\Controllers;

use App\Services\WebhookService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request, WebhookService $webhookService)
    {
        dd($request->all());
        $webhookService->run($request->all());

        return response()->json('Ok');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\WebhookService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request, WebhookService $webhookService)
    {
        $webhookService->run($request->all());
    }
}

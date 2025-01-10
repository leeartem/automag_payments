<?php

namespace App\Http\Controllers;

use App\Services\WebhookService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhookPush(Request $request, WebhookService $webhookService)
    {
        $webhookService->run($request->all());

        return response()->json('Ok');
    }
}

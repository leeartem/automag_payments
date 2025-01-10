<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

//Route::post('/webhook/eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ', [WebhookController::class, 'webhook']);
Route::any('/webhook/eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ', [WebhookController::class, 'webhook']);

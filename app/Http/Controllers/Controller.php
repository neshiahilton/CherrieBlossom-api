<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Cherrie Blossom API",
 *      version="1.0.0",
 *      description="This  is the API documentation  for Cherrie Blossom."
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
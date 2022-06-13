<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 *  @OA\Info(
 *     version="1.0.0",
 *     title="Book organizer API"
 *   )
 *
 * @OA\SecurityScheme (
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      name="Authorization",
 *      in="header",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

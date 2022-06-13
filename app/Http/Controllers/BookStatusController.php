<?php

namespace App\Http\Controllers;

use App\Models\BookStatus;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BookStatusController extends Controller {

    use ApiResponse;

    /**
     * @OA\Get(
     *     path="/bookStatuses/",
     *     description="Get list of all statuses",
     *     tags={"Statuses"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/BookStatus")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized.",
     *     ),
     * )
     */
    public function getAll(Request $req) {
        $statuses = BookStatus::all();
        return $this->sendResponse($statuses, 'OK', 200);
    }

    public function get($id, Request $req) {
        $status = BookStatus::find($id);
        if($status == null)
            return $this->sendError('Not found', 404);
        return $this->sendResponse($status, 'OK', 200);
    }

    //
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Book",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="contents",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="date"
 *  ),
 *  @SWG\Property(
 *      property="updated_at",
 *      type="date"
 *  )
 * )
 */
class Book extends Model {
    use HasFactory;
}

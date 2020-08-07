<?php

namespace App\Traits;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
trait ApiResponser
{


	protected function errorResponse($message, $code){
		return response()->json(['error' => $message, 'code' => $code], $code);
	}


}

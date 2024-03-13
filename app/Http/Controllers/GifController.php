<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveGifRequest;
use App\Models\Gif;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class GifController extends Controller
{
    public function save(User $user, SaveGifRequest $request)
    {
        return DB::transaction(function () use ($user, $request) {
            $gif = new Gif($request->validated());
            $gif->user()->associate($user);
            $gif->saveOrFail();

            return new JsonResource($gif);
        });
    }
}

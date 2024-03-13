<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveGifRequest;
use App\Http\Requests\SearchGifRequest;
use App\Models\Gif;
use App\Models\User;
use App\Services\GifService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class GifController extends Controller
{
    public function search(SearchGifRequest $request)
    {
        /** @var GifService $service */
        $service = App::make(GifService::class);
        $response = $service->search(
            $request->validated('query'),
            $request->validated('limit'),
            $request->validated('offset')
        );
        return response()->json($response);
    }

    public function show(string $id)
    {
        /** @var GifService $service */
        $service = App::make(GifService::class);
        $response = $service->get($id);
        return response()->json($response);
    }

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

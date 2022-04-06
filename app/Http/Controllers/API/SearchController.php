<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\TokenRequest;
use App\Http\Requests\API\Search\SuggestionRequest;
use App\Http\Requests\API\Search\KeywordRequest;
use App\Models\Word;
use App\Http\Resources\Search\SuggestionResource;
use App\Http\Resources\Search\KeywordResource;
class SearchController extends Controller
{
    /**
     * Suggestions
     */

    /**
     * @OA\Get(
     *     path="/search/suggestions",
     *     operationId="suggestions",
     *     tags={"Search"},
     *     summary="Available Suggestions for keyword",
     *      @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *    @OA\Response(
     *      response=400,ref="#/components/schemas/BadRequest"
     *    ),
     *    @OA\Response(
     *      response=404,ref="#/components/schemas/Notfound"
     *    ),
     *    @OA\Response(
     *      response=500,ref="#/components/schemas/Forbidden"
     *    )
     * )
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ExampleStoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggestions(SuggestionRequest $request)
    {
        $suggestions = Word::where('lemma', 'LIKE', $request->keyword.'%')
        ->get();
        return SuggestionResource::collection($suggestions);
    }

    /**
     * Keywords
     */

    /**
     * @OA\Get(
     *     path="/search/keywords",
     *     operationId="keywords",
     *     tags={"Search"},
     *     summary="Get Keywords",
     *      @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *    @OA\Response(
     *      response=400,ref="#/components/schemas/BadRequest"
     *    ),
     *    @OA\Response(
     *      response=404,ref="#/components/schemas/Notfound"
     *    ),
     *    @OA\Response(
     *      response=500,ref="#/components/schemas/Forbidden"
     *    )
     * )
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ExampleStoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function keywords(KeywordRequest $request)
    {
        $keywords = Word::where('lemma', $request->keyword)->with('senses.synset.lexname')
        ->get();

        return KeywordResource::collection($keywords);
    }
}
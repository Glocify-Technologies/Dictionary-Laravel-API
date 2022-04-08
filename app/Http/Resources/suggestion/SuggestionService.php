<?php

namespace App\Http\Resources\suggestion;

use GuzzleHttp\Client as GuzzleClient;

class SuggestionService
{
    /**
     * Suggestions return into array.
     *
     * @param  $keyword
     */
    public function suggestion($keyword)
    {
        $suggestionArray = [];
        $url = 'https://jspell-checker.p.rapidapi.com/check';

        $data = [
            'language' => 'enUS',
            'fieldvalues' => $keyword,
            'config' => [
                'forceUpperCase' => false,
                'ignoreIrregularCaps' => false,
                'ignoreFirstCaps' => false,
                'ignoreNumbers' => false,
                'ignoreUpper' => false,
                'ignoreDouble' => false,
                'ignoreWordsWithNumbers' => true,
            ]
        ];

        $headers = [
            'X-RapidAPI-Host' => 'jspell-checker.p.rapidapi.com',
            'X-RapidAPI-Key' => '690dd7b2admsh820b135f989539ep1e57cejsnc01db4536b10',
        ];

        $client = new GuzzleClient([
            'headers' => $headers
        ]);

        $r = $client->request('POST', $url, ['body' => json_encode($data)]);
        $response = $r->getBody()->getContents();
        $responseData = json_decode($response, true);
        if (!empty($responseData)) {
            foreach ($responseData['elements'] as $key => $responses) {
                foreach ($responses['errors'][0]['suggestions'] as $suggest) {
                    array_push($suggestionArray, $suggest);
                }
            }
        }
        $data = [
            'suggestion' => $suggestionArray
        ];
        return $data;
    }
}

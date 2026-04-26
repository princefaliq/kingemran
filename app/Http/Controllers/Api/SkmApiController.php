<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SkmApiController extends Controller
{
    public function index()
    {
        $client = new Client();

        try {
            $response = $client->post('https://apps.bondowosokab.go.id/ws/indeks/data-kepuasan-masyarakat', [
                'headers' => [
                    'Content-Type' => 'application/json', // Or the appropriate content type
                    'Accept' => 'application/json',      // Tell the server you want JSON back
                    'BCC-key' => 'A1b@X3#d9', // Example of a custom header
                    // Add any other headers required by the API here
                ],
                'json' => [ // Use 'json' to send a JSON body
                    'tahun' => date('Y')-1,
                    'opd_id' => 'tlogosari'
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents(); // Get the response body as a string
            $ikm = json_decode($body, true); // Decode JSON to an array

            // Process $data


        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions (connection errors, timeouts, etc.)
            \Log::error("Guzzle Error: " . $e->getMessage());
            // Or, re-throw the exception
            // throw $e;
            $ikm = $e->getMessage();
        }
        return response()->json($ikm);
    }
}

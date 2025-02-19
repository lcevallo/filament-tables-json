<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl;
    protected $username;
    protected $password;
    protected $sucursal;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL');
        $this->username = env('API_USERNAME');
        $this->password = env('API_PASSWORD');
        $this->sucursal = env('API_SUCURSAL');
    }

    public function getAccessToken()
    {
        // Realiza la solicitud HTTP para obtener el token
        $response = Http::asForm()->post("{$this->baseUrl}/auth/sign-in?sucursal={$this->sucursal}", [
            'grant_type' => 'password', // O el valor que requiera la API
            'username' => $this->username,
            'password' => $this->password,
            'scope' => '', // Si es necesario
            'client_id' => '', // Si es necesario
            'client_secret' => '', // Si es necesario
        ]);

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            // Decodifica la respuesta JSON y retorna el access_token
            return $response->json()['access_token'];
        }

        // Si la solicitud no fue exitosa, registra el error y retorna null
        Log::error('Failed to get access token', [
            'status' => $response->status(),
            'response' => $response->body(),
        ]);

        return null;
    }

    public function getPlanDeCuentas($accessToken)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'accept' => 'application/json', // Agrega el header 'accept'
        ])->post("{$this->baseUrl}/plandecuentas/cmb/", [
            // Si el endpoint requiere un cuerpo vacío, puedes omitir este array
            // Si requiere algún dato en el cuerpo, agrégualo aquí
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('Failed to get plan de cuentas', [
            'status' => $response->status(),
            'response' => $response->body(),
        ]);

        return null;
    }
}

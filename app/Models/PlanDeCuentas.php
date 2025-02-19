<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Sushi\Sushi;
use App\Services\ApiService;

class PlanDeCuentas extends Model
{
    use Sushi;

    protected $fillable = [
        'id', 'nombre'
    ];

    protected $casts = [
        'id' => 'string',
        'nombre' => 'string',

    ];

    public function getRows()
    {
        $apiService = app(ApiService::class);
        $accessToken = $apiService->getAccessToken();


        if (!$accessToken) {
            return [];
        }

         // Obtener los datos de la API
         $planDeCuentas = $apiService->getPlanDeCuentas($accessToken);

         // Depuración: Mostrar los datos en bruto de la API
         // dd($planDeCuentas);

        if (!$planDeCuentas) {
            return [];
        }

        // Mapea los datos de la API al formato esperado por Sushi
        return Arr::map($planDeCuentas, function ($item) {
            return [
                'id' => (string) $item['id'],
                'nombre' => (string) $item['nombre']
            ];
        });
    }

}

<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        Response::macro('success', function ($data = [], $message = null, $status = 200) {

            $defaultMessage = $message ?? __('default.success');

            $response = ['status' => true, 'message' => $defaultMessage];

            if ($data instanceof AnonymousResourceCollection) {
                // If it's a paginated collection
                if ($data->resource instanceof LengthAwarePaginator) {
                    $paginator = $data->resource;

                    $response['data']       = $data->collection; // already mapped
                    $response['pagination'] = [
                        'total'        => $paginator->total(),
                        'per_page'     => $paginator->perPage(),
                        'current_page' => $paginator->currentPage(),
                        'last_page'    => $paginator->lastPage(),
                        'from'         => $paginator->firstItem(),
                        'to'           => $paginator->lastItem(),
                    ];
                } else {
                    $response['data'] = $data->collection; // for non-paginated collection
                }
            } else {
                $response['data'] = $data; // plain data
            }

            return response()->json($response, $status);

        });

        Response::macro('error', function ($message = null, $status = 400, $errors = []) {
            $defaultMessage = $message ?? __('default.error');

            $response = ['status' => false, 'message' => $defaultMessage, 'errors' => $errors];

            return response()->json($response, $status);
        });
    }
}

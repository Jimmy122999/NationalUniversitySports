<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) {

                // This will only accept alpha and spaces. 
                return preg_match('/^[\pL\s]+$/u', $value); 

            });

        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
                    $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
                    return new LengthAwarePaginator(
                        $this->forPage($page, $perPage),
                        $total ?: $this->count(),
                        $perPage,
                        $page,
                        [
                            'path' => LengthAwarePaginator::resolveCurrentPath(),
                            'pageName' => $pageName,
                        ]
                    );
                });
    }
}

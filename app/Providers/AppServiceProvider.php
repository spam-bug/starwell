<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Vite;
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
        Validator::extend('alpha_spaces', function ($attributes, $value) {
            return preg_match('/^[\pL\s]/u', $value);
        });

        Validator::extend('ph_mobile_number', function ($attributes, $value) {
            return preg_match('/^(09|\+639)\d{9}$/s', $value);
        });

        Validator::extend('currency', function ($attributes, $value) {
            return preg_match('/^[\d,]+(\.\d{1,2})?$/', $value);
        });

        Blade::directive('admin', function ($expression) {
            return "<?php if(auth()->user()->isAdmin()): ?>";
        });

        Blade::directive('endAdmin', function ($expression) {
            return '<?php endif; ?>';
        });

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

        Vite::macro('image', fn (string $asset) => $this->asset("resources/images/{$asset}"));
        Vite::macro('video', fn (string $asset) => $this->asset("resources/videos/{$asset}"));
    }
}

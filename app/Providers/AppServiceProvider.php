<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\GlobalSetting\app\Models\CustomPagination;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $setting = Cache::rememberForever('setting', function () {
                $setting_info = Setting::get();
                $setting = [];
                foreach ($setting_info as $setting_item) {
                    $setting[$setting_item->key] = $setting_item->value;
                }
                $setting = (object) $setting;

                return $setting;
            });


            // setup timezone globally
            config(['app.timezone' => $setting?->timezone]);


            Cache::rememberForever('CustomPagination', function () {
                $custom_pagination = CustomPagination::all();
                $pagination = [];
                foreach ($custom_pagination as $item) {
                    $pagination[str_replace(' ', '_', strtolower($item?->section_name))] = $item?->item_qty;
                }
                $pagination = (object) $pagination;
                return $pagination;
            });
        } catch (Exception $ex) {
            $setting = null;
            Log::error($ex->getMessage());
        }

        View::composer('*', function ($view) {
            $setting = Cache::get('setting');

            $view->with('setting', $setting);
        });

        /**
         * Register custom blade directives
         * this can be used for permission or permissions check
         * this check will be perform on admin guard
         */
        $this->registerBladeDirectives();
        Paginator::useBootstrapFour();
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('adminCan', function ($permission) {
            return "<?php if(auth()->guard('admin')->user()->can({$permission})): ?>";
        });

        Blade::directive('endadminCan', function () {
            return '<?php endif; ?>';
        });
    }
}

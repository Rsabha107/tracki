<?php

namespace App\Providers;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // URL::forceScheme('https');
        if($this->app->environment('azure')) {
            URL::forceScheme('https');
        }


        Carbon::setWeekendDays([
            Carbon::FRIDAY,
            Carbon::SATURDAY,
        ]);

        try {
            DB::connection()->getPdo();
            // The table exists in the database
            $statuses = Status::all();
            $priorities = Priority::all();
            // $user_workspace = auth()->user()->workspaces;
            $workspaces = Workspace::all();
            // $general_settings = get_settings('general_settings');


            // dd($workspaces);

            $data = [   'statuses' => $statuses,
                        'priorities' => $priorities,
                        'workspaces' => $workspaces,
                        // 'general_settings' => $general_settings,
                    ];

            view()->share($data);
        } catch (\Exception $e) {
        }

    }
}

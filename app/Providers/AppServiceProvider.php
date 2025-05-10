<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\OwnerPolicy;
use App\Models\Owners;
use App\Models\Car;

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
        Gate::policy(Owners::class, OwnerPolicy::class);
        Gate::define('ChangeLanguage', function ($user) {
            return true;
        });

        Gate::define('DeleteOwners', function ($user, Owners $owners) {
            if ($user->id==$owners->user_id){
                return true;}

            if ($user->type=='admin'){
                return true;}

            return false;
        });

        Gate::define('EditOwners', function ($user, Owners $owners) {
            if ($user->id==$owners->user_id){
                return true;}

            if ($user->type=='admin'){
                return true;}

            return false;});

        Gate::define('EditCars', function ($user, Car $car) {
            if ($car->owner && $car->owner->user_id == $user->id) {
                return true;}

            if ($user->type === 'admin') {
                return true;}

            return false;});

        Gate::define('DeleteCars', function ($user, Car $car) {
            if ($car->owner && $car->owner->user_id == $user->id) {
                return true;}

            if ($user->type === 'admin') {
                return true;}

            return false;});
    }
}

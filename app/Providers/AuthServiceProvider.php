<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    // Add your policy mappings here
  ];

  /**
   * Register any application services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    Gate::define('isOrangTua', function (User $user) {
      return $user->role === 'Orang Tua';
    });

    Gate::define('isAdmin', function (User $user) {
      $allowedRoles = ['Keasramaan', 'Kemahasiswaan', 'Dosen', 'Kaprodi', 'Komdis', 'Rektor'];
      return in_array($user->role, $allowedRoles);
    });

    Gate::define('isKeasramaan', function (User $user) {
      return $user->role === 'Keasramaan';
    });

    Gate::define('isKemahasiswaan', function (User $user) {
      return $user->role === 'Kemahasiswaan';
    });
  }
}

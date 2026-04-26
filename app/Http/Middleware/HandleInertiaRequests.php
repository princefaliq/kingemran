<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $routeName = $request->route()?->getName() ?? '';
        $user = $request->user();

        return [
            ...parent::share($request),
            'appName' => config('app.name'),
            'site_key' => config('services.recaptcha.site_key'),
            'auth' => [
                'user' => $user,
                'roles' => $user ? $user->getRoleNames() : [],
                'permissions' => $user ? $user->getAllPermissions()->pluck('name') : [],
            ],
            // ✅ TAMBAHKAN INI
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error'   => fn () => $request->session()->get('error'),
                'warning' => fn () => $request->session()->get('warning'),
                'info'    => fn () => $request->session()->get('info'),
            ],
            'bodyClass' => match(true) {
                str_starts_with($routeName, 'admin.login')
                => 'auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat',
                str_starts_with($routeName, 'admin.')
                => 'header-fixed header-tablet-and-mobile-fixed',

                default
                => 'public-site',
            },
        ];
    }
}

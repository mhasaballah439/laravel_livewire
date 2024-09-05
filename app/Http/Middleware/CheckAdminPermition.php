<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class CheckAdminPermition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

            $admin = admin();
            $currentRouteName = Route::currentRouteName();

            if ($admin->is_super == 0 && isset($admin->permition_group)) {
                $permition_links = $admin->permition_group->links;
                if (!is_array($permition_links))
                    $permition_links = json_decode($permition_links);

                $link = Link::whereIn('id', $permition_links)->where('route_name', $currentRouteName)->first();
                if (!$link)
                    return redirect()->route('dashboard.permition_denide');
            }

        return $next($request);
    }
}

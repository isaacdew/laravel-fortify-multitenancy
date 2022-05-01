<?php

namespace Isaacdew\LaravelFortifyMultitenancy;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class SetTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $host = parse_url($request->url(), PHP_URL_HOST);
        $parts = explode('.', $host);
        if(count($parts) > 2) {
            $tenantId = Tenant::select('id')->where('subdomain', $parts[0])->firstOrFail();
            config(['tenant.id' => $tenantId]);
        }

        return $next($request);
    }
}

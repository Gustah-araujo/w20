<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CastDateInputs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() != 'get') {

            $date_fields = [
                'expires_at',
                'date',
            ];

            $input = $request->all();

            foreach ($date_fields as $field) {

                if ( isset( $input[$field] ) ) {
                    $input[$field] = Carbon::createFromFormat('d/m/Y', $input[$field]);
                }

            }

            $request->replace( $input );
        }

        return $next($request);
    }
}

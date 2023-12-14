<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClearCurrencyInputs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() != 'get') {

            $currency_fields = [
                'price'
            ];

            $input = $request->all();

            foreach ($currency_fields as $field) {

                if ( isset( $input[$field] ) ) {
                    $input[$field] = intval( preg_replace('/[^0-9]/', '', $input[$field]) );
                }

            }

            $request->replace( $input );
        }

        return $next($request);
    }
}

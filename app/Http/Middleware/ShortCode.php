<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ShortCode as ShortCodeModel;

class ShortCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  // Start before system loads
        $response = $next($request);
        if ($response instanceof \Illuminate\Http\Response && str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $content = $response->getContent();

            // Get all shortcodes from DB
            $shortcodes = ShortCodeModel::all();

            foreach ($shortcodes as $shortcode) {$content = str_replace('[[' . $shortcode->shortcode . ']]', $shortcode->replace, $content);}

            $response->setContent($content);
        }
        // Starts after system loads
        return $response;
    }
}

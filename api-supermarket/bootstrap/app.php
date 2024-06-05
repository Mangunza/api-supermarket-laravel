<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Lançar exceção quando houver erro de autenticação, exceção do tipo: AuthenticationException
        $exceptions->render(function(AuthenticationException $e){

            // Retornar msg de erro e status 401
            return response()->json([
                'status' => false,
                'messagem' => 'Token de authenticação inválida.',
            ]);
        });
    })->create();

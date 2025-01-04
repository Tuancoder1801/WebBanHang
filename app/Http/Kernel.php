protected $routeMiddleware = [
    // Các middleware khác
    'checkLoggedIn' => \App\Http\Middleware\CheckLoggedIn::class,
];
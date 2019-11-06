<?php

namespace App\Exceptions;

    use Exception;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use Illuminate\Auth\AuthenticationException;
    use Auth;

    class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
      /*if($exception instanceof AuthenticationException){
        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
          case 'admin':
            $login = 'admin.login';
            break;

          case 'organiser':
            $login = 'organiser.login';
            break;

          case 'raadsheer':
            $login = 'raadsheer.login';
            break;


          default:
            $login = 'gilde.login';
            break;
        }
      }*/
      return parent::render($request, $exception);

    }
    protected function unauthenticated($request, AuthenticationException $exception)
        {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);

            } elseif ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->guest('/admin/login/');

            } elseif ($request->is('organiser') || $request->is('organiser/*')) {
                return redirect()->guest('/organiser/login/');

            } elseif ($request->is('gilde') || $request->is('gilde/*')) {
                return redirect()->guest('/gilde/login/');
                
            } elseif ($request->is('raadsheer') || $request->is('raadsheer/*')) {
                return redirect()->guest('/raadsheer/login/');
            }

            return redirect()->guest(route('/'));
        }

}

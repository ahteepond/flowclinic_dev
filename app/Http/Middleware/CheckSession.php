<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cur_session = session()->get('session_username');
        if ($cur_session == null) {
            return redirect('logout');
        } else {
            $select = DB::table('user')
            ->where(['username' => $cur_session])
            ->first();
            if (empty($select)) {
                return redirect('logout');
            };
        };
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkPermission
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
        if(Auth::user()->role_id !=1){
            //ROLE_ID KHÁC 1 CÓ NGHĨA NÓ KHÔNG PHẢI LÀ ADMIN THÌ SẼ ĐẨY VỀ TRANG HOME.
            return redirect()->route('home_index');
        }
        return $next($request);//Trả về trang yêu cầu
    }
}

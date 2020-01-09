<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware
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
        // Permission Settings
        // ===========================================================================================
        // if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
        //     {
        //         return $next($request);
        //     }
        if ($request->is('roles')) //If user is view a post
            {
                if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) {
                    abort('401');
                } else {
                    return $next($request);
                }
            }
        //  Permission Main Menu

        // ======================================END=====================================================
        // Permission Master Data
        // ============================================================================================
        // Employee data by HRD
        if ($request->is('master-employee-detail')) //If user is view a post
            {
                if (!Auth::user()->hasPermissionTo('Employee Master by HRD')) {
                    abort('401');
                } else {
                    return $next($request);
                }
            }
        if ($request->is('manage-department')) {
            if (!Auth::user()->hasPermissionTo('Manage Department')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        if ($request->is('manage-division')) {
            if (!Auth::user()->hasPermissionTo('Manage Division')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        if ($request->is('manage-position')) {
            if (!Auth::user()->hasPermissionTo('Manage Position')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        // Employee Data by ADMIN
        if ($request->is('users')) //If user is view a post
            {
                if (!Auth::user()->hasPermissionTo('Employee Master by Admin')) {
                    abort('401');
                } else {
                    return $next($request);
                }
            }
        // News Master
        if ($request->is('dashboard/create')) {
            if (!Auth::user()->hasPermissionTo('News Master')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        if ($request->is('dashboard/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit News')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete News')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        // =====================================END=========================================================

        return $next($request);
    }
}

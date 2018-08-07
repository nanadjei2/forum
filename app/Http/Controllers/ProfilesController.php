<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Users can view their profile page
     * Route Key Name Changed which means instead of using 
     * the unique ids(by default) of the users to pull their records the route will 
     * rather user their names as stated in: new (\App\Users)->getRouteKeyName() method
     * @param  \App\User $user 
     * @return \Illuminate\Http\Response
     */
    public function show(\App\User $user) // profiles/Elvis Adjei Nti/
    {
        return view('profiles.show', ['profileUser' => $user]);
    }
}

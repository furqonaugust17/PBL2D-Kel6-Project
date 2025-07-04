<?php
function hasAnyRole($roles)
{
    return Auth::check() && Auth::user()->hasAnyRole($roles);
}

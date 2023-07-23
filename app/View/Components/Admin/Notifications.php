<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notifications extends Component
{
    /**
     * Create a new component instance.
     */
    // Notifications collection
    public $notifications; //to call relation from laravel
    public $unread;
    public function __construct()
    {
       $user = Auth::user();
       $this->notifications = $user->readNotifications()->limit(5)->get(); // to point relation from laravel
       $this->unread = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.notifications');
    }
}

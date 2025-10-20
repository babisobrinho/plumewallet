<?php

namespace App\Livewire\Shared\Profile;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LogoutOtherBrowserSessionsForm extends Component
{
    /**
     * Indicates if logout is being confirmed.
     *
     * @var bool
     */
    public $confirmingLogout = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Confirm that the user would like to log out from other browser sessions.
     *
     * @return void
     */
    public function confirmLogout()
    {
        $this->password = '';

        $this->dispatch('confirming-logout-other-browser-sessions');

        $this->confirmingLogout = true;
    }

    /**
     * Log out from other browser sessions.
     *
     * @return void
     */
    public function logoutOtherBrowserSessions()
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            $this->addError('password', __('This password does not match our records.'));

            return;
        }

        Auth::logoutOtherDevices($this->password);

        $this->deleteOtherSessionRecords();

        $this->confirmingLogout = false;

        $this->dispatch('loggedOut');
    }

    /**
     * Delete the other browser session records from storage.
     *
     * @return void
     */
    protected function deleteOtherSessionRecords()
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', '!=', request()->session()->getId())
            ->delete();
    }

    /**
     * Get the current sessions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSessionsProperty()
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            return (object) [
                'agent' => [
                    'is_desktop' => $this->isDesktop($session->user_agent),
                    'platform' => $this->getPlatform($session->user_agent),
                    'browser' => $this->getBrowser($session->user_agent),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === request()->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Determine if the user agent is a desktop device.
     *
     * @param  string  $userAgent
     * @return bool
     */
    protected function isDesktop($userAgent)
    {
        return ! preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $userAgent);
    }

    /**
     * Get the platform from the user agent.
     *
     * @param  string  $userAgent
     * @return string
     */
    protected function getPlatform($userAgent)
    {
        if (preg_match('/windows/i', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            return 'macOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/android/i', $userAgent)) {
            return 'Android';
        } elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            return 'iOS';
        }

        return 'Unknown';
    }

    /**
     * Get the browser from the user agent.
     *
     * @param  string  $userAgent
     * @return string
     */
    protected function getBrowser($userAgent)
    {
        if (preg_match('/chrome/i', $userAgent) && !preg_match('/edg/i', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/firefox/i', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/edg/i', $userAgent)) {
            return 'Edge';
        } elseif (preg_match('/opera|opr/i', $userAgent)) {
            return 'Opera';
        }

        return 'Unknown';
    }

    public function render()
    {
        return view('livewire.shared.profile.logout-other-browser-sessions-form');
    }
}

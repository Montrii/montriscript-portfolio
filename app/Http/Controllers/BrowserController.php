<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;

class BrowserController extends Controller
{
    //
    public function getBrowserInformation(Request $request)
    {
        return ['browserInfo' => [
            'browserVersion' => [
                'isBot' => Browser::isBot(),
                'isFirefox' => Browser::isFirefox(),
                'isChrome' => Browser::isChrome(),
                'isSafari' => Browser::isSafari(),
                'isIE' => Browser::isIE(),
                'isInApp' => Browser::isInApp(),
                'isEdge' => Browser::isEdge(),
                'isOpera' => Browser::isOpera(),
            ],
            'browserOS' => [
                'isWindows' => Browser::isWindows(),
                'isMacOriOS' => Browser::isMac(),
                'isLinux' => Browser::isLinux(),
                'isAndroid' => Browser::isAndroid(),
            ]
        ]];
    }
}

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    /*
     * Activate new user account email.
     *
     */

    'activationSubject'  => 'Activation required',
    'activationGreeting' => 'Welcome to ECRcentral!',
    'activationMessage'  => 'You need to activate your email before you can start using ECRcentral.',
    'activationButton'   => 'Activate',
    'activationThanks'   => 'Thank you for your interest in ECRcentral!',

    /*
     * Goobye email.
     *
     */
    'goodbyeSubject'  => 'Sorry to see you go...',
    'goodbyeGreeting' => 'Hello :username,',
    'goodbyeMessage'  => 'We are very sorry to see you go. We wanted to let you know that your account has been deleted. Thank for the time we shared. You have '.config('settings.restoreUserCutoff').' days to restore your account.',
    'goodbyeButton'   => 'Restore Account',
    'goodbyeThanks'   => 'We hope to see you again!',

];

<?php

declare(strict_types=1);

return [

    /*
     * ----------------------------------------------------
     * Brevo API Key
     * ----------------------------------------------------
     *
     * Getting started with the Brevo API:
     * https://developers.brevo.com/docs/getting-started#quick-start
     *
     * Get your API key:
     * https://app.brevo.com/settings/keys/api
     */

    'api_key' => env('BREVO_API_KEY', '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'),

    'partner_key' => env('BREVO_PARTNER_KEY', null),

];

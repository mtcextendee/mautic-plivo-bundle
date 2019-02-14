<?php

/*
 * @copyright   2018 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'services' => [
        'events'  => [],
        'forms'   => [
        ],
        'helpers' => [],
        'other'   => [
            'mautic.sms.transport.plivo' => [
                'class'     => \MauticPlugin\MauticPlivoBundle\Services\PlivoApi::class,
                'arguments' => [
                    'mautic.page.model.trackable',
                    'mautic.helper.phone_number',
                    'mautic.helper.integration',
                    'monolog.logger.mautic',
                    'mautic.http.connector'
                ],
                'alias' => 'mautic.sms.config.transport.plivo',
                'tag'          => 'mautic.sms_transport',
                'tagArguments' => [
                    'integrationAlias' => 'Plivo',
                ],
            ],
        ],
        'models'       => [],
        'integrations' => [
            'mautic.integration.plivo' => [
                'class' => \MauticPlugin\MauticPlivoBundle\Integration\PlivoIntegration::class,
            ],
        ],
    ],
    'routes'     => [],
    'menu'       => [],
    'parameters' => [
    ],
];

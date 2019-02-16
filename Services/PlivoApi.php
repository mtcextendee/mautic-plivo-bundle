<?php
/*
 * @copyright   2018 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @author      Jan Kozak <galvani78@gmail.com>
 */

namespace MauticPlugin\MauticPlivoBundle\Services;

use Guzzle\Http\Client;
use Joomla\Http\Http;
use Mautic\CoreBundle\Exception\BadConfigurationException;
use Mautic\CoreBundle\Helper\PhoneNumberHelper;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\PageBundle\Model\TrackableModel;
use Mautic\PluginBundle\Helper\IntegrationHelper;
use Mautic\SmsBundle\Api\AbstractSmsApi;
use Monolog\Logger;
use Plivo\Exceptions\PlivoRestException;
use Plivo\RestClient;

class PlivoApi extends AbstractSmsApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var string
     */
    protected $originator;

    /**
     * @var IntegrationHelper
     */
    private $integrationHelper;

    /**
     * @var Http
     */
    private $http;

    /**
     * MessageBirdApi constructor.
     *
     * @param TrackableModel    $pageTrackableModel
     * @param PhoneNumberHelper $phoneNumberHelper
     * @param IntegrationHelper $integrationHelper
     * @param Logger            $logger
     *
     * @param Http              $http
     */
    public function __construct(TrackableModel $pageTrackableModel, PhoneNumberHelper $phoneNumberHelper, IntegrationHelper $integrationHelper, Logger $logger, Http $http)
    {
        $this->logger = $logger;
        $this->integrationHelper = $integrationHelper;
        $this->http = $http;
        $this->client = $http;
        parent::__construct($pageTrackableModel);
    }

    /**
     * @param Lead   $contact
     * @param string $content
     *
     * @return bool|mixed|string
     */
    public function sendSms(Lead $contact, $content)
    {
        if (!$contact->getMobile()) {
            return false;
        }

        $integration = $this->integrationHelper->getIntegrationObject('Plivo');
        if ($integration && $integration->getIntegrationSettings()->getIsPublished()) {
            $data   = $integration->getDecryptedApiKeys();
            $client = new RestClient($data['AUTH_ID'], $data['AUTH_TOKEN']);
            try {
                $response = $client->messages->create(
                    $data['sender_phone_number'],
                    [$contact->getMobile()],
                    $content
                );

                return true;
            } catch (PlivoRestException $ex) {
                if (method_exists($ex, 'getErrorMessage')) {
                    return $ex->getErrorMessage();
                } elseif (!empty($ex->getMessage())) {
                    return $ex->getMessage();
                }

                return false;
            }
        }
    }
}

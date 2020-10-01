<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\CloudDocker\Compose\ProductionBuilder\Service;

use Magento\CloudDocker\Compose\BuilderInterface;
use Magento\CloudDocker\Compose\ProductionBuilder\ServiceBuilderInterface;
use Magento\CloudDocker\Config\Config;
use Magento\CloudDocker\Service\ServiceFactory;
use Magento\CloudDocker\Service\ServiceInterface;

/**
 *
 */
class Blackire implements ServiceBuilderInterface
{
    /**
     * @var ServiceFactory
     */
    private $serviceFactory;

    /**
     *
     * @param ServiceFactory $serviceFactory
     */
    public function __construct(ServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return ServiceInterface::SERVICE_BLACKFIRE;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(Config $config): array
    {
        return $this->serviceFactory->create(
            ServiceInterface::SERVICE_BLACKFIRE,
            $config->getServiceVersion(ServiceInterface::SERVICE_BLACKFIRE),
            [
                'environment' => [
                    'BLACKFIRE_SERVER_ID' => $config->getBlackfireConfig()['server_id'],
                    'BLACKFIRE_SERVER_TOKEN' => $config->getBlackfireConfig()['server_token'],
                    'BLACKFIRE_CLIENT_ID' => $config->getBlackfireConfig()['client_id'],
                    'BLACKFIRE_CLIENT_TOKEN' => $config->getBlackfireConfig()['client_token']
                ],
                'ports' => ["8707"]
            ]
        );
    }

    public function getNetworks(): array
    {
        return [BuilderInterface::NETWORK_MAGENTO];
    }

    public function getDependsOn(Config $config): array
    {
        return [];
    }
}

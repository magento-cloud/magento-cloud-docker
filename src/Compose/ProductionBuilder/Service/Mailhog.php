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
class Mailhog implements ServiceBuilderInterface
{
    /**
     * @var ServiceFactory
     */
    private $serviceFactory;

    public function __construct(ServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return BuilderInterface::SERVICE_MAILHOG;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(Config $config): array
    {
        return $this->serviceFactory->create(
            ServiceInterface::SERVICE_MAILHOG,
            $this->serviceFactory->getDefaultVersion(BuilderInterface::SERVICE_MAILHOG),
            [
                'ports' => [
                    $config->getMailHogSmtpPort() . ':1025',
                    $config->getMailHogHttpPort() . ':8025',
                ]
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

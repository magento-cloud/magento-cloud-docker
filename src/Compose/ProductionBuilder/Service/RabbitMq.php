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

/**
 *
 */
class RabbitMq implements ServiceBuilderInterface
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
        return BuilderInterface::SERVICE_RABBITMQ;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->getName();
    }

    /**
     * @inheritDoc
     */
    public function getConfig(Config $config): array
    {
        return $this->serviceFactory->create(
            $this->getServiceName(),
            $config->getServiceVersion($this->getServiceName())
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

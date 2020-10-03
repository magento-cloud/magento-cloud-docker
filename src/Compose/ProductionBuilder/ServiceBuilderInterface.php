<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\CloudDocker\Compose\ProductionBuilder;

use Magento\CloudDocker\Config\Config;

interface ServiceBuilderInterface
{
    /**
     * Returns name of the service from BuilderInterface
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns name of the service from ServiceInterface
     *
     * @return string
     */
    public function getServiceName(): string;

    /**
     * Returns service configuration based on general configuration
     *
     * @param Config $config
     * @return mixed
     */
    public function getConfig(Config $config): array;

    public function getNetworks(): array;

    public function getDependsOn(Config $config): array;
}

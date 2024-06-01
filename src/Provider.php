<?php

declare(strict_types=1);

namespace MultipleChain\Boilerplate;

use MultipleChain\Enums\ErrorType;
use MultipleChain\Types\NetworkConfig;
use MultipleChain\Interfaces\Services\ProviderInterface;

class Provider implements ProviderInterface
{
    /**
     * @var NetworkConfig
     */
    private NetworkConfig $network;

    /**
     * @var Provider|null
     */
    private static ?Provider $instance;

    /**
     * @param NetworkConfig $networkConfig
     */
    public function __construct(NetworkConfig $networkConfig)
    {
        $this->update($networkConfig);
    }

    /**
     * @return Provider
     */
    public static function instance(): Provider
    {
        if (null === self::$instance) {
            throw new \RuntimeException(ErrorType::PROVIDER_IS_NOT_INITIALIZED->value);
        }
        return self::$instance;
    }

    /**
     * @param NetworkConfig $networkConfig
     * @return void
     */
    public static function initialize(NetworkConfig $networkConfig): void
    {
        if (null !== self::$instance) {
            throw new \RuntimeException(ErrorType::PROVIDER_IS_ALREADY_INITIALIZED->value);
        }
        self::$instance = new self($networkConfig);
    }

    /**
     * @param NetworkConfig $networkConfig
     * @return void
     */
    public function update(NetworkConfig $networkConfig): void
    {
        $this->network = $networkConfig;
        self::$instance = $this;
    }

    /**
     * @return bool
     */
    public function isTestnet(): bool
    {
        return $this->network->isTestnet();
    }

    /**
     * @param string|null $url
     * @return bool
     */
    public function checkRpcConnection(?string $url = null): bool
    {
        return true;
    }

    /**
     * @param string|null $url
     * @return bool
     */
    public function checkWsConnection(?string $url = null): bool
    {
        return true;
    }
}

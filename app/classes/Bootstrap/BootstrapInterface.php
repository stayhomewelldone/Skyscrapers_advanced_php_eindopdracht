<?php

namespace Buildings\Bootstrap;

/**
 * Interface BootstrapInterface
 * @package Buildings\Bootstrap
 */
interface BootstrapInterface
{
    public function setup(): void;

    public function render(): string;
}

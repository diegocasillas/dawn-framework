<?php

namespace Dawn\App;

interface ServiceProviderInterface
{
    public function register();

    public function boot();
}
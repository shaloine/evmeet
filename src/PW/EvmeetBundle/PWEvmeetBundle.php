<?php

namespace PW\EvmeetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PWEvmeetBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}

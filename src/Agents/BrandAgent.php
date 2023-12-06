<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;

class BrandAgent extends BaseAgent
{
    /**
     * @param int $a
     * @param int $b
     * @return int
     * @aiagent-description Adds two numbers together
     */
    public function add(int $a, int $b): int {
        return $a + $b;
    }

    
}
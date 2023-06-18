<?php

namespace Modules\Settings\Http\Controllers\Actions\TopAgents;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\AgentSocials;
use Modules\Settings\TopAgent;
use Modules\Settings\Http\Resources\TopAgents\TopAgentResource;

class CreateTopAgentAction
{
    function execute($data)
    {
        $user_id = $data['user_id'];
        // Create top_agent
        $top_agent = TopAgent::create([
            'user_id' => $user_id
        ]);
        if (isset($data['socials']) && !empty($data['socials'])) {
            foreach ($data['socials'] as $social) {
                AgentSocials::create([
                    'top_agent_id' => $top_agent->id,
                    'link' => $social['link'],
                    'icon' => $social['icon']
                ]);
            }
        }
        // return transformed response
        return new TopAgentResource($top_agent);
    }
}

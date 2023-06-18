<?php

namespace Modules\Settings\Http\Controllers\Actions\TopAgents;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Settings\AgentSocials;
use Modules\Settings\TopAgent;
use Modules\Settings\Http\Resources\TopAgents\TopAgentResource;

class UpdateTopAgentAction
{
    function execute($id, $data)
    {
        // Find top_agent
        $top_agent = TopAgent::find($id);

        AgentSocials::where('top_agent_id', $top_agent->id)->delete();
        
        if (isset($data['socials']) && !empty($data['socials'])) {
            foreach ($data['socials'] as $social) {
                AgentSocials::create([
                    'top_agent_id' => $top_agent->id,
                    'link' => $social['link'],
                    'icon' => $social['icon']
                ]);
            }
        }
        // Update top_agent 
        $top_agent->update($data);


        // Return transformed response
        return new TopAgentResource($top_agent);
    }
}

<?php

namespace Modules\Settings\Http\Controllers\Actions\TopAgents;

use Modules\Settings\TopAgent;

class DeleteTopAgentAction
{
    public function execute($id)
    {
        // Delete top_agent 
        TopAgent::find($id)->delete();

        // return the response
        return null;
    }
}

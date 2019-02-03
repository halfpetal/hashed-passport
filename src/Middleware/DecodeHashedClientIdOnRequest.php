<?php

namespace Halfpetal\HashedPassport\Middleware;

use Closure;
use Illuminate\Http\Request;
use Halfpetal\HashedPassport\Traits\HashesIds;

class DecodeHashedClientIdOnRequest
{
    use HashesIds;

    /**
     * @param $request Request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->offsetExists('client_id'))
        {
            $client_id = $request->offsetGet('client_id');

            if ( ! is_numeric($client_id))
            {
                $result = $this->decode($client_id);

                if (count($result) > 0)
                {
                    $request->offsetSet('client_id', $result[0]);
                }
                else
                {
                    $request->offsetSet('client_id', -1);
                }
            }
        }

        return $next($request);
    }
}

<?php
namespace Luisinder\Middleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
Class IpControl
{
  protected $trustedIp;
	public function __construct(array $trustedIp = [])
	{
    $this->trustedIp = $trustedIp;
	}
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
	{
		if (!$next) {
			return $response;
		}

    if(!($this->checkIp($request->$req->getAttribute('ip_address'))))
    {
      $response = $response
                ->withStatus(401)
                ->withHeader("WWW-Authenticate", sprintf('Basic realm="%s"', $this->options["realm"]));
    }
    else
    {
      return $response = $next($request, $response);
    }
	}
	protected function checkIp($ip)
	{
		if(array_search($ip,$this->trustedIp)== FALSE)
      return false;
    else
      return true;
	}
}

<?php
namespace Luisinder\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

Class IpControl
{
  protected $trustedIp;
  protected $redirectUrl;

  public function __construct(array $trustedIp = [], string $redirectUrl = "/")
  {
    $this->trustedIp = $trustedIp;
    $this->redirectUrl = $redirectUrl;
  }

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
  {
    if (!$next)
    {
     return $response;
   }

   $ipAddress = $this->determineClientIpAddress($request);

   if(!($this->checkIp($ipAddress)))
   {
    return $response->withRedirect($this->redirectUrl);
  }
  else
  {
    return $response = $next($request, $response);
  }
}

protected function checkIp($ip)
{
  if(array_search($ip,$this->trustedIp) == FALSE)
    return false;
  else
    return true;
}

protected function determineClientIpAddress($request)
{
  $ipAddress = null;
  $serverParams = $request->getServerParams();
  if (isset($serverParams['REMOTE_ADDR']) && $this->isValidIpAddress($serverParams['REMOTE_ADDR']))
  {
    $ipAddress = $serverParams['REMOTE_ADDR'];
  }
  return $ipAddress;
}

protected function isValidIpAddress($ip)
{
  $flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
  if (filter_var($ip, FILTER_VALIDATE_IP, $flags) === false)
  {
    return false;
  }
  return true;
}
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['jwt_key'] = '@k4t4p4nd42o2o';

/*Generated token will expire in 1 minute for sample code
* Increase this value as per requirement for production
*/
$config['token_timeout'] = 1*60*60*1; // 1 jam
$config['token_timeout_mobile'] = 1*60*60*168; // 1 minggu

/* End of file jwt.php */
/* Location: ./application/config/jwt.php */
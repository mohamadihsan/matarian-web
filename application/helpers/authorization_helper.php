<?php

class AUTHORIZATION {

    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
            return $token;
        }
        return false;
    }

    public static function validateToken()
    {
        $CI =& get_instance();
        $headers = $CI->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $explodeToken = explode(' ', $headers['Authorization'] , 2);
            $bearer = $explodeToken[0];
            if ($bearer == 'Bearer') {
                $token = $explodeToken[1] ;
                try {
                    return JWT::decode($token, $CI->config->item('jwt_key'));
                } catch (\Exception $e){
                    $CI->response([
                        'status' => false,
                        'message' => 'Unauthorised',
                        'data' => []
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }
            }
        }
        
        $CI->response([
            'status' => false,
            'message' => 'Bearer not found',
            'data' => []
        ], REST_Controller::HTTP_UNAUTHORIZED);
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

}
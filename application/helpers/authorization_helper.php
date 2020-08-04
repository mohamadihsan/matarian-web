<?php

class AUTHORIZATION {

    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout')))) {
            return $token;
        }
        return false;
    }

    public static function validateToken()
    {
        try {
            
            $CI =& get_instance();
            $headers = $CI->input->request_headers();

            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                $explodeToken = explode(' ', $headers['Authorization'] , 2);
                $bearer = $explodeToken[0];
                if ($bearer == 'Bearer') {
                    $token = $explodeToken[1];
                    try {
                        $token_decode = JWT::decode($token, $CI->config->item('jwt_key'), array('HS256'));

                        if ((now() - $token_decode->exp < ($CI->config->item('token_timeout')))) {
                            return $token_decode;
                        }
                        
                        $CI->response([
                            'status' => false,
                            'code' => "05",
                            'message' => 'Token Expired...',
                            'data' => []
                        ], REST_Controller::HTTP_UNAUTHORIZED);

                    } catch (\Exception $e){
                        $CI->response([
                            'status' => false,
                            'code' => "06",
                            'message' => 'Unauthorised',
                            'data' => []
                        ], REST_Controller::HTTP_UNAUTHORIZED);
                    }
                }
            }

            $CI->response([
                'status' => false,
                'code' => "07",
                'message' => 'Bearer not found',
                'data' => []
            ], REST_Controller::HTTP_UNAUTHORIZED);

        } catch (\Throwable $th) {
            //throw $th;
            $CI->response([
                'status' => false,
                'code' => "99",
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }
        
    }

    public static function validateTokenOnPage()
    {
        try {

            $CI =& get_instance();
            $session = $CI->session->userdata('auth');
            $token = $session['token'];
            $token_decode = JWT::decode($token, $CI->config->item('jwt_key'), array('HS256'));

            if ($CI->uri->segment(1) == '' || $CI->uri->segment(1) == 'login' || $CI->uri->segment(1) == 'register') {
                if ($token_decode) {
                    
                    if ((now() - $token_decode->exp < ($CI->config->item('token_timeout')))) {
                        redirect('/dashboard','refresh');
                    } else {
                        session_destroy();
                        redirect('/','refresh');
                    }
                    
                }
            } else {
                if ($token_decode) {
                    
                    if ((now() - $token_decode->exp < ($CI->config->item('token_timeout')))) {
                        return $token;
                    } else {
                        session_destroy();
                        redirect('/','refresh');
                    }
                    
                } else {

                    session_destroy();
                    redirect('/','refresh');
                    
                }
            }

        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

}
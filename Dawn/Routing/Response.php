<?php

namespace Dawn\Routing;

/**
 * Holds the response information.
 */
class Response
{
    /**
     * The status code number.
     *
     * @var integer
     */
    protected $statusCode;

    /**
     * The status message.
     *
     * @var string
     */
    protected $statusMessage;

    /**
     * Array that contains the response data.
     *
     * @var array
     */
    protected $data;

    /**
     * Indicate if the response is in JSON format.
     *
     * @var boolean
     */
    protected $json = false;

    /**
     * Create a new Response instance.
     *
     * @param array $data
     * @param integer $statusCode
     */
    public function __construct($data = null, $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    /**
     * Set the status code and message.
     *
     * @param integer $code
     * @param string $message
     * @return $this
     */
    public function status($code, $message = null)
    {
        $this->statusCode = $code;

        if ($message !== null) {
            $this->statusMessage = $message;
        } else {
            $this->autoMessage($code);
        }

        return $this;
    }

    /**
     * Set the response data.
     *
     * @param array $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Add JSON header.
     *
     * @return $this
     */
    public function json()
    {
        $this->header('Content-Type', 'application/json');

        $this->json = true;

        return $this;
    }

    /**
     * Add a header by name and value.
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function header($name, $value)
    {
        header($name . ": " . $value);

        return $this;
    }

    /**
     * Add a Authentication: Bearer header with the specified token.
     *
     * @param string $token
     * @return $this
     */
    public function token($token)
    {
        $this->header('Authentication', 'Bearer ' . $token);

        return $this;
    }

    /**
     * Set an automatic status message by a status code.
     *
     * @param integer $code
     * @return string
     */
    public function autoMessage($code)
    {
        $statuses = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            103 => 'Early Hints',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            208 => 'Already Reported',
            226 => 'IM Used',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Switch Proxy',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Payload Too Large',
            414 => 'URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            421 => 'Misdirected Request',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Request',
            431 => 'Request Header Fields Too Large',
            451 => 'Unavailable For Legal Reasons',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            508 => 'Loop Detected',
            510 => 'Not Extended',
            511 => 'Network Authentication Required'
        ];

        if (array_key_exists($code, $statuses)) {
            $this->statusMessage = $statuses[$code];
        }

        return $this->statusMessage;
    }

    /**
     * Send the response.
     *
     * @return $this
     */
    public function send()
    {
        http_response_code($this->statusCode);

        $this->statusMessage = $this->autoMessage($this->statusCode);

        if ($this->json === true) {
            echo json_encode($this);
        }

        return $this;
    }

    /**
     * Get the status code.
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the status code.
     *
     * @param integer $statusCode
     * @return void
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Get the status message.
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * Set the status message.
     *
     * @param string $statusMessage
     * @return void
     */
    public function setStatusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }

    /**
     * Get the response data array.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the response data array.
     *
     * @param array $data
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get JSON boolean value.
     *
     * @return boolean
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * Set JSON boolean value.
     *
     * @param boolean $json
     * @return void
     */
    public function setJson($json)
    {
        $this->json = $json;
    }
}

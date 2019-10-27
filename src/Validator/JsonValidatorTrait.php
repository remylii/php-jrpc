<?php
namespace JRpc\Validator;

use JRpc\Exception\ResponseFailureException;

trait JsonValidatorTrait
{
    /**
     * @throws ResponseFailureException
     */
    public function jsonValidate()
    {
        $json_error = json_last_error();
        if ($json_error != JSON_ERROR_NONE) {
            switch ($json_error) {
                case JSON_ERROR_DEPTH:
                    $msg = "JSON_ERROR_DEPTH";
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $msg = "JSON_ERROR_STATE_MISMATCH";
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $msg = "JSON_ERROR_CTRL_CHAR";
                    break;
                case JSON_ERROR_SYNTAX:
                    $msg = "JSON_ERROR_SYNTAX";
                    break;
                case JSON_ERROR_UTF8:
                    $msg = "JSON_ERROR_UTF8";
                    break;
                default:
                    $msg = "error";
                    break;
            }

            throw new ResponseFailureException($msg);
        }

        return true;
    }
}

<?php

namespace app\modules\api\components;

use Yii;
use yii\rest\Controller;
// use JsonSchema\SchemaStorage;
// use JsonSchema\Validator;
// use JsonSchema\Constraints\Factory;
// use JsonSchema\Constraints\Constraint;

class BaseController extends Controller
{

    /**
     * Api Validate error response
     */
    public function apiValidate($strErrors, $strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 422;
        return [
            'code' => 422,
            'name' => 'ValidateErrorException',
            'message' => $strMessage ? $strMessage : 'Error validation',
            'errors' => $strErrors
        ];
    }

    /**
     * Api Created response
     */
    public function apiCreated($data, $strMessage = false, $status, $substatus_code)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 201;
        return [
            'code' => $status,
            'sub_status_code' => $substatus_code,
            'message' => $strMessage ? $strMessage : 'Created successfully',
            'data' => $data
        ];
    }

    /**
     * Api Updated response
     */
    public function apiUpdated($data, $strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 202;
        return [
            'code' => 202,
            'message' => $strMessage ? $strMessage : 'Updated successfully',
            'data' => $data
        ];
    }

    /**
     * Api Deleted response
     */
    public function apiDeleted($data, $strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 202;
        return [
            'code' => 202,
            'message' => $strMessage ? $strMessage : 'Deleted successfully',
            'data' => $data
        ];
    }

    /**
     * Api Item response
     */
    public function apiItem($data, $strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return [
            'code' => 200,
            'message' => $strMessage ? $strMessage : 'Data retrieval successfully',
            'data' => $data
        ];
    }

    /**
     * Api Collection response
     */
    public function apiCollection($data, $total = 0, $strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return [
            'code' => 200,
            'message' => $strMessage ? $strMessage : 'Data retrieval successfully',
            'data' => $data,
            'total' => 0
        ];
    }

    /**
     * Api Success response
     */
    public function apiSuccess($strMessage = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'code' => 200,
            'message' => $strMessage ? $strMessage : 'Success',
        ];
    }

    public function apiNotMatched($strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 404;
        return [
            'code' => 404,
            'status' => 'fail',
            'message' => $strMessage ? $strMessage : 'Success',
        ];
    }

    public function apiRequestNotMatched($strMessage = false)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 501;
        return [
            'code' => 501,
            'status' => 'fail',
            'message' => 'Requested HTTP Method/headers Not Valid.',
        ];
    }

    /**
     * Api response
     */
    public function apiResponse($strStatusCode, $strStatus = '',  $data = [], $arrOptionalParam = [])
    {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = $strStatusCode;
        $return_arr['code'] = $strStatusCode;
        $return_arr['status'] = $strStatus;

        if(!empty($arrOptionalParam)){
            foreach( $arrOptionalParam as $strIndex => $strValue){
                $return_arr[$strIndex] = $strValue;
            }
        }
        $return_arr['data'] = $data;
        return $return_arr;
    }


    // public function validateRequest($jsonData,$module) {
    //     $jsonschema = Yii::getAlias('@jsonschema');
    //     $jsonValidator = new Validator();           
    //     $jsonToValidateObject = json_decode($jsonData);
    //     if($module == "WESCO") {        
    //         $jsonValidator->validate($jsonToValidateObject, (object) array('$ref' => $jsonschema.'/ccsm_schema.json'));        
    //     }
    //     if ($jsonValidator->isValid()) {
    //        return true;
    //     }  else {
    //         return $jsonValidator->getErrors();
    //     }
    // }
}
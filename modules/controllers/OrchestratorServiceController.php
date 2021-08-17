<?php

namespace app\modules\api\controllers;

use Yii;
use yii\helpers\Json;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use app\modules\api\components\BaseController;
use app\modules\api\components\OrchestratorComponent;
use app\modules\api\models\ApiLogs;

/**
 * OrchestratorService controller for the `api` module
 */
class OrchestratorServiceController extends BaseController
{
    private $moduleType = '';
    private $intCurrentBandwidth = '';
    private $strUniqueId = '';
    protected $serviceType = '';
    protected $circuitId = '';

    private function checkApiModule() {
        return ['WESCO'];
    }

    public function actionGetBestPath()
    {
        $this->strUniqueId = uniqid();  
        $request = Yii::$app->request;
        $contentType = $request->headers->get('content-type');
        if (($request->isPost) && ($contentType == 'application/json')) {
            $jsonRequestData = Yii::$app->request->getRawBody();
            return $this->manipulatedRequestData($jsonRequestData);
        } else {
            return $this->apiRequestNotMatched();
        }
    }

    public function actionGetRestorePath()
    {
        $this->strUniqueId = uniqid();
        $request = Yii::$app->request;
        $contentType = $request->headers->get('content-type');
        if (($request->isPost) && ($contentType == 'application/json')) {
            $jsonRequestData = Yii::$app->request->getRawBody();
            return $this->manipulatedRestoreData($jsonRequestData);
        } else {
            return $this->apiRequestNotMatched();
        }
    }

    private function manipulatedRequestData($jsonRequestData)
    {
        $arrOutputLists = [];
        try {
            $arrRequestData = Json::decode($jsonRequestData, true);
            $strGetModuleType = isset($arrRequestData['module_type']) ? $arrRequestData['module_type'] : '';
            if (empty($strGetModuleType) || (!in_array($strGetModuleType, $this->checkApiModule()))) {
                return $this->apiNotMatched('Invalid Module Type.');
            } else {
                $this->moduleType = $arrRequestData['module_type'];
                $validatedData = $this->validateRequest($jsonRequestData, $this->moduleType);                    
                if($validatedData == 1) { 
                   
                } else {
                    $jointMessage = '';
                    foreach($validatedData as $error) {
                        $jointMessage .= 'In '.$error['property'].': '.$error['message'];
                    }
                    return $this->apiNotMatched($jointMessage);
                }
            }

            $arrOutput = [];
            $arrOutput['strUniqueId'] = $this->strUniqueId;
            $arrOutput['module_type'] = $arrRequestData['module_type'];
            $arrOutput['app_url'] = Url::base(true) . '/api/orchestrator-service/get-best-path';
            $arrOutput['request_type'] = 'POST';
            $arrOutput['request_method'] = $jsonRequestData;
            $arrOutput['response_method'] = json_encode($arrOutputLists);
            $arrOutput['status'] = ApiLogs::SUCCESS_STATUS;
            ApiLogs::saveApiLogs($arrOutput);
            unset($arrOutput);
            return $arrOutputLists;
        } catch (InvalidArgumentException $jsonError) {
            $msg =  $jsonError->getMessage();
            return $this->apiResponse(401, 'Failed', $msg);
        }
    }


}
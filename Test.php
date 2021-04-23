<?php


use Fdd\FddServer;

require __DIR__ . '/vendor/autoload.php';


$fdd = new FddServer('40***5', '41Kjo5***Omkr7d0Hj7', "https://testapi.fadada.com:8443/api/");
//$accountRegister = $fdd->accountRegister('open_id', 1);
//$customer_id = $accountRegister->data;
$result = $fdd->addSignature('07BDE1D40CCCD26E51DA440EF84A4F12',"https://img0.baidu.com/it/u=2563232234,119593447&fm=26&fmt=auto&gp=0.jpg" );
//4991582
//4991583
var_dump($result);die();



//获取企业实名认证地址
//$getCompanyVerifyUrl = $fdd->getPersonVerifyUrl($customer_id,'https://member.cn1.utools.club/Test.php','18300715792','王亮');
//var_dump($getCompanyVerifyUrl);
//$customSignature = $fdd->customSignature($customer_id,'dawdwa dwa ');
//var_dump($customSignature);
//$uploadDocs = $fdd->uploadDocs('12123123','测试合同上传','./模板.pdf');
//var_dump($uploadDocs);
//$uploadTemplate = $fdd->uploadTemplate('11111111111','./模板.pdf');
//var_dump($uploadTemplate);
//$viewTemplate = $fdd->viewTemplate('11111111111');
//echo $viewTemplate;
//$templateDownload = $fdd->templateDownload('11111111111',1);
//echo $templateDownload;
//file_put_contents('测试模板下载.pdf', $templateDownload);
//$templateDelete = $fdd->templateDelete('12123123');
//var_dump($templateDelete);
//object(stdClass)#8 (2) {
//["code"]=>
//  int(1)
//  ["msg"]=>
//  string(7) "success"
//}
//$data = ['sign_person'=>'签字'];
//$generateContract = $fdd->generateContract('内容替换','11111111111','11111111111',json_encode($data));
//var_dump($generateContract);

//$extSignAuto = $fdd->extSignAuto('20210000000','11111111111',$customer_id,1,'自动签字');
//var_dump($extSignAuto);
//$extSignAuto = $fdd->extSign('20210000000','11111111111',$customer_id,1,'手动');
//var_dump($extSignAuto);
//$viewContract = $fdd->viewContract('12123123');
//echo $viewContract;

$downLoadContract = $fdd->downLoadContract('11111111111',1);
file_put_contents('测试合同下载.pdf', $downLoadContract);
//echo $downLoadContract;
//$contractFiling = $fdd->contractFiling('12123123');
//var_dump($contractFiling);

$findPersonCertInfo = $fdd->findPersonCertInfo('7b2f7789fc6c4b64b143ab4dfb63bc6b');
var_dump($findPersonCertInfo);

<?php


namespace Fdd;


interface FddInterface
{

    public function accountRegister( $open_id,  $account_type = 1);/*用户或企业账号 获取客户编码*/
    public function getCompanyVerifyUrl($customer_id, $notify_url, $legal_info, $page_modify = 1, $company_principal_type = 1);/*获取企业实名认证地址*/
    public function getPersonVerifyUrl($customer_id, $notify_url, $mobile = '', $customer_name = '', $customer_ident_no = '', $ident_front_path = '', $verified_way = '1', $page_modify = '1', $cert_flag = '1', $customer_ident_type = 0);/*获取个人实名认证地址*/
    public function applyCert($customer_id, $verified_serialno);
    public function addSignature($customer_id, $file_path);
    public function customSignature($customer_id, $content);
    public function uploadDocs($contract_id, $doc_title, $file = '', $doc_url = '', $doc_type = '.pdf');
    public function uploadTemplate($template_id, $file, $doc_url = '', $doc_type = '.pdf');
    public function viewTemplate(string $template_id);
    public function templateDownload($template_id, $return_url = null);
    public function templateDelete($template_id);
    public function generateContract($doc_title, $template_id, $contract_id, $parameter_map, $font_size = '', $font_type = 0);
    public function extSignAuto($transaction_id, $contract_id, $customer_id, $client_role = '1', $doc_title = '', $position_type = '0', $sign_keyword = '', $keyword_strategy = '0', $notify_url = '');
    public function extSign($transaction_id, $contract_id, $customer_id, $doc_title, $return_url = '', $sign_keyword = '', $notify_url = ''): string;
    public function viewContract(string $contract_id);
    public function downLoadContract(string $contract_id, $return_url = null);
    public function contractFiling($contract_id);
    public function getFile($uuid, $return_url = null);
    public function findPersonCertInfo($verified_serialno);
    public function findCompanyCertInfo($verified_serialno);
    public function beforeAuthsign($transaction_id, $contract_id, $customer_id, $return_url , $notify_url , $auth_type = 1);
    public function getAuthStatus($customer_id);
    public function cancelExtsignAutoPage($customer_id);
    public function personVerifySign($transaction_id, $contract_id, $customer_id, $return_url, $notify_url, $verified_notify_url, $verified_way = 0, $page_modify = 1);
}
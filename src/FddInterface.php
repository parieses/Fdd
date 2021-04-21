<?php


namespace Fdd;


interface FddInterface
{

    public function accountRegister( $open_id,  $account_type = 1);/*用户或企业账号 获取客户编码*/
    public function getCompanyVerifyUrl($customer_id, $notify_url, $legal_info, $page_modify = 1, $company_principal_type = 1);/*获取企业实名认证地址*/
    public function getPersonVerifyUrl($customer_id, $notify_url, $mobile = '', $customer_name = '', $customer_ident_no = '', $ident_front_path = '', $verified_way = '1', $page_modify = '1', $cert_flag = '1', $customer_ident_type = 0);/*获取个人实名认证地址*/
}
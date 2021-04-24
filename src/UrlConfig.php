<?php


namespace Fdd;


class UrlConfig
{
    //注册账号
    public const REGISTER = '/api/account_register.api';
    //获取企业实名认证地址
    public const GET_COMPANY_VERIFY_URL = '/api/get_company_verify_url.api';
    //获取个人实名认证地址
    public const GET_PERSON_VERIFY_URL = '/api/get_person_verify_url.api';
    //实名证书申请
    public const APPLY_CERT = '/api/apply_cert.api';
    //印章上传
    public const ADD_SIGNATURE = '/api/add_signature.api';
    //自定义印章
    public const CUSTOM_SIGNATURE = '/api/custom_signature.api';
    //合同上传
    public const UPLOAD_DOCS = '/api/uploaddocs.api';
    //模板上传
    public const UPLOAD_TEMPLATE = '/api/uploadtemplate.api';
    //模板填充
    public const GENERATE_CONTRACT = '/api/generate_contract.api';
    //自动签署
    public const EXTSIGN_AUTO = '/api/extsign_auto.api';
    //手动签署
    public const EXT_SIGN = '/api/extsign.api';
    //合同查看
    public const VIEW_CONTRACT = '/api/viewContract.api';
    //合同下载
    public const DOWNLOAD_CONTRACT = '/api/downLoadContract.api';
    //合同归档
    public const CONTRACT_FILING = '/api/contractFiling.api';
    //查询个人实名认证信息
    public const FIND_PERSON_CERT_INFO = '/api/find_personCertInfo.api';
    //查询企业实名认证信息
    public const FIND_COMPANY_CERT_INFO = '/api/find_companyCertInfo.api';
    //通过uuid下载文件
    public const GET_FILE = '/api/get_file.api';
    //合同模板查看
    public const VIEW_TEMPLATE = '/api/view_template.api';
    //合同模板下载
    public const DOWNLOAD_TEMPLATE = '/api/download_template.api';
    //模板删除
    public const TEMPLATE_DELETE = '/api/template_delete.api';
    //授权页面接口
    public const BEFORE_AUTHSIGN =  '/api/before_authsign.api';
    //查询授权自动签状态接口
    public const GET_AUTH_STATUS = '/api/get_auth_status.api';
    //取消授权签协议接口
    public const CANCEL_EXTSIGN_AUTO_PAGE= '/api/cancel_extsign_auto_page.api';
}
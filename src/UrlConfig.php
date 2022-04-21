<?php


namespace Fdd;


class UrlConfig
{
    //注册账号
    public const REGISTER = '/account_register.api';
    //获取企业实名认证地址
    public const GET_COMPANY_VERIFY_URL = '/get_company_verify_url.api';
    //获取个人实名认证地址
    public const GET_PERSON_VERIFY_URL = '/get_person_verify_url.api';
    //实名证书申请
    public const APPLY_CERT = '/apply_cert.api';
    //印章上传
    public const ADD_SIGNATURE = '/add_signature.api';
    //自定义印章
    public const CUSTOM_SIGNATURE = '/custom_signature.api';
    //合同上传
    public const UPLOAD_DOCS = '/uploaddocs.api';
    //模板上传
    public const UPLOAD_TEMPLATE = '/uploadtemplate.api';
    //模板填充
    public const GENERATE_CONTRACT = '/generate_contract.api';
    //自动签署
    public const EXTSIGN_AUTO = '/extsign_auto.api';
    //手动签署
    public const EXT_SIGN = '/extsign.api';
    //合同查看
    public const VIEW_CONTRACT = '/viewContract.api';
    //合同下载
    public const DOWNLOAD_CONTRACT = '/downLoadContract.api';
    //合同归档
    public const CONTRACT_FILING = '/contractFiling.api';
    //查询个人实名认证信息
    public const FIND_PERSON_CERT_INFO = '/find_personCertInfo.api';
    //查询企业实名认证信息
    public const FIND_COMPANY_CERT_INFO = '/find_companyCertInfo.api';
    //通过uuid下载文件
    public const GET_FILE = '/get_file.api';
    //合同模板查看
    public const VIEW_TEMPLATE = '/view_template.api';
    //合同模板下载
    public const DOWNLOAD_TEMPLATE = '/download_template.api';
    //模板删除
    public const TEMPLATE_DELETE = '/template_delete.api';
    //授权页面接口
    public const BEFORE_AUTHSIGN = '/before_authsign.api';
    //查询授权自动签状态接口
    public const GET_AUTH_STATUS = '/get_auth_status.api';
    //取消授权签协议接口
    public const CANCEL_EXTSIGN_AUTO_PAGE = '/cancel_extsign_auto_page.api';
    //快捷签署接口（个人）
    public const PERSON_VERIFY_SIGN = '/person_verify_sign.api';
}

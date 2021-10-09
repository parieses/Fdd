<?php

namespace Fdd;

use Curl\Curl;
use CURLFile;
use UnexpectedValueException;

class FddServer implements FddInterface
{
    private $appId;
    private $appSecret;
    private $timestamp;
    private $version = '2.0';
    private $curl;
    private $baseUrl = '';


    public function __construct($appId, $appSecret, $baseUrl)
    {
        $this->timestamp = date("YmdHis");
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->baseUrl = $baseUrl;
        $this->curl = new Curl();
    }

    /**
     * 注册账号
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:accountRegister
     * status:
     * User: Mr.liang
     * Date: 2021/4/20
     * Time: 14:23
     * Email:1695699447@qq.com
     * @param string $open_id      :用户在接入方的唯一标识字符(len<=64)
     * @param int    $account_type :1个人2企业
     * @return mixed
     */
    public function accountRegister($open_id, $account_type = 1)
    {
        $params = $this->getParams(compact('account_type', 'open_id'));
        $url = $this->baseUrl . UrlConfig::REGISTER;
        return $this->curl->post($url, $params);
    }

    /**
     * 获取企业实名认证地址
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:getCompanyVerifyUrl
     * status:
     * User: Mr.liang
     * Date: 2021/4/20
     * Time: 17:18
     * Email:1695699447@qq.com
     * @param     $customer_id            :客户编号
     * @param     $notify_url             :回调地址
     * @param     $legal_info             :法人信息
     * @param int $page_modify            :是否允许用户修改页面1允许2不允许
     * @param int $company_principal_type :企业负责人身份1法人2代理人
     * @return null
     */
    public function getCompanyVerifyUrl($customer_id, $notify_url, $legal_info, $page_modify = 1, $company_principal_type = 1)
    {
        $params = $this->getParams(compact('company_principal_type', 'customer_id', 'legal_info', 'notify_url', 'page_modify'));
        $url = $this->baseUrl . UrlConfig::GET_COMPANY_VERIFY_URL;
        return $this->curl->post($url, $params);
    }

    /**
     *获取个人实名认证地址
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:getPersonVerifyUrl
     * status:
     * User: Mr.liang
     * Date: 2021/4/20
     * Time: 18:22
     * Email:1695699447@qq.com
     * @param        $customer_id         :客户标识
     * @param        $notify_url          :回调地址
     * @param string $mobile              :手机号
     * @param string $customer_name       :客户名称
     * @param string $customer_ident_no
     * @param string $ident_front_path
     * @param string $verified_way
     * @param string $page_modify
     * @param string $cert_flag           :是否认证成功后自动申请实名证书 参数值为“0”:不申请参数值为“1”:自动申请
     * @param int    $customer_ident_type :证件类型0身份证1其他
     * @param int    $is_mini_program     :是否跳转法大大公证处小程序认证
     * @return null
     */
    public function getPersonVerifyUrl(
        $customer_id,
        $notify_url,
        $mobile = '',
        $customer_name = '',
        $customer_ident_no = '',
        $ident_front_path = '',
        $verified_way = '1',
        $page_modify = '1',
        $cert_flag = '1',
        $customer_ident_type = 0,
        $is_mini_program = 0,
    ) {
        $params = $this->getParams(
            compact('customer_id', 'notify_url', 'verified_way', 'page_modify', 'cert_flag', 'customer_ident_no', 'customer_ident_type', 'customer_name', 'mobile', 'ident_front_path', 'is_mini_program')
        );
        $url = $this->baseUrl . UrlConfig::GET_PERSON_VERIFY_URL;
        return $this->curl->post($url, $params);
    }

    /**
     * 实名证书申请
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:applyCert
     * status:
     * User: Mr.liang
     * Date: 2021/4/20
     * Time: 18:54
     * Email:1695699447@qq.com
     * @param $customer_id
     * @param $verified_serialno
     * @return null |null
     */
    public function applyCert($customer_id, $verified_serialno)
    {
        $params = $this->getParams(compact('customer_id', 'verified_serialno'));
        $url = $this->baseUrl . UrlConfig::APPLY_CERT;
        return $this->curl->post($url, $params);
    }

    /**
     * 印章上传
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:addSignature
     * status:
     * User: Mr.liang
     * Date: 2021/4/20
     * Time: 19:33
     * Email:1695699447@qq.com
     * @param $customer_id :客户标识
     * @param $file_path   :文件路径
     * @return null |null
     */
    public function addSignature($customer_id, $file_path)
    {
        $signature_img_base64 = $this->getImageToBase64($file_path);
        $params = $this->getParams(compact('customer_id', 'signature_img_base64'));
        $url = $this->baseUrl . UrlConfig::ADD_SIGNATURE;
        return $this->curl->post($url, $params);
    }

    /**
     * 自定义印章
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:customSignature
     * status:
     * User: Mr.liang
     * Date: 2021/4/20
     * Time: 19:35
     * Email:1695699447@qq.com
     * @param $customer_id :客户编号
     * @param $content     :印章展示的内容
     * @return array
     */
    public function customSignature($customer_id, $content)
    {
        $params = $this->getParams(compact('content', 'customer_id'));
        $url = $this->baseUrl . UrlConfig::CUSTOM_SIGNATURE;
        return $this->curl->post($url, $params);
    }

    /**
     * 合同上传
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:uploadDocs
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 9:08
     * Email:1695699447@qq.com
     * @param        $contract_id :合同编号
     * @param        $doc_title   :合同名称
     * @param string $file        :文件
     * @param string $doc_url     :pdf url
     * @param string $doc_type
     * @return null |null
     */
    public function uploadDocs($contract_id, $doc_title, $file = '', $doc_url = '', $doc_type = '.pdf')
    {
        $msg_digest = $this->getMsgDigest(compact('contract_id'));
        $personalParams = [
            //业务参数
            'contract_id' => $contract_id,
            'doc_title' => $doc_title,
            'doc_url ' => $doc_url,
            'file' => new CURLFile($file),
            'doc_type' => $doc_type,
        ];
        $params = array_merge($this->getCommonParams($msg_digest), $personalParams);
        $url = $this->baseUrl . UrlConfig::UPLOAD_DOCS;
        return $this->curl->post($url, $params);
    }

    /**
     * 模板上传
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:uploadTemplate
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 9:32
     * Email:1695699447@qq.com
     * @param        $template_id :模板id
     * @param        $file        :文件
     * @param        $doc_url     :文件url
     * @param string $doc_type    :类型
     * @return array
     */
    public function uploadTemplate($template_id, $file, $doc_url = '', $doc_type = '.pdf')
    {
        $msg_digest = $this->getMsgDigest(compact('template_id'));
        $personalParams = [
            //业务参数
            'template_id' => $template_id,
            'doc_url' => $doc_url,
            'file' => new CURLFile($file),
            'doc_type' => $doc_type,
        ];
        $params = array_merge($this->getCommonParams($msg_digest), $personalParams);
        $url = $this->baseUrl . UrlConfig::UPLOAD_TEMPLATE;
        return $this->curl->post($url, $params);
    }

    /**
     * 模板查看
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:viewTemplate
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 9:41
     * Email:1695699447@qq.com
     * @param string $template_id :模板id
     * @return null |null
     */
    public function viewTemplate(string $template_id)
    {
        $params = $this->getParams(compact('template_id'));
        $url = $this->baseUrl . UrlConfig::VIEW_TEMPLATE;
        return $this->curl->post($url, $params);
    }

    /**
     * 模板下载
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:templateDownload
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 9:48
     * Email:1695699447@qq.com
     * @param      $template_id :模板id
     * @param null $return_url  :是否返回链接或者文件
     * @return null |null
     */
    public function templateDownload($template_id, $return_url = null)
    {
        $params = $this->getParams(compact('template_id'));
        $url = $this->baseUrl . UrlConfig::DOWNLOAD_TEMPLATE;
        return $return_url ? $this->curl->post($url, $params) : $url . '?' . http_build_query($params);
    }

    /**
     * 模板删除
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:templateDelete
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 9:49
     * Email:1695699447@qq.com
     * @param $template_id :模板id
     * @return null |null
     */
    public function templateDelete($template_id)
    {
        $params = $this->getParams(compact('template_id'));
        $url = $this->baseUrl . UrlConfig::TEMPLATE_DELETE;
        return $this->curl->post($url, $params);
    }

    /**
     * 模板填充
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:generateContract
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 9:54
     * Email:1695699447@qq.com
     * @param $doc_title     :标题
     * @param $template_id   :模板id
     * @param $contract_id   :合同编号
     * @param $font_size     :字体
     * @param $parameter_map :填充内容JsonObject字符串key为文本域,value为要填充的值,value值传字符
     * @param $font_type     :默认0 0-宋体;1-仿宋;2-黑体;3-楷体;4-微软雅黑
     * @return null |null
     */
    public function generateContract($doc_title, $template_id, $contract_id, $parameter_map, $font_size = '', $font_type = 0)
    {
        $msg_digest = $this->getMsgDigest(compact('template_id', 'contract_id'), $parameter_map);
        $personalParams = [
            //业务参数
            'doc_title' => $doc_title,
            'template_id' => $template_id,
            'contract_id' => $contract_id,
            'font_size' => $font_size,
            'parameter_map' => $parameter_map,
            'font_type' => $font_type,
        ];
        $params = array_merge($this->getCommonParams($msg_digest), $personalParams);
        $url = $this->baseUrl . UrlConfig::GENERATE_CONTRACT;
        return $this->curl->post($url, $params);
    }

    /**
     * 自动签署
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:extSignAuto
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 10:15
     * Email:1695699447@qq.com
     * @param        $transaction_id   :交易编号
     * @param        $contract_id      :合同编号
     * @param        $customer_id      :客户
     * @param string $client_role      :客户角色  1-接入平台；2-仅适用互金行业担保公司或担保人；3-接入平台客户（互金行业指投资人）；4-仅适用互金行业借款企业或者借款人如果需要开通自动签权限请联系法
     * @param string $doc_title        :文档标题
     * @param string $position_type    :定位类型
     * @param string $sign_keyword     :定位关键字
     * @param string $keyword_strategy :签章策略
     * @param string $notify_url       :异步通知URL
     * @return null |null
     */
    public function extSignAuto($transaction_id, $contract_id, $customer_id, $client_role = '1', $doc_title = '', $position_type = '0', $sign_keyword = '', $keyword_strategy = '0', $notify_url = '')
    {
        $msg_digest = base64_encode(
            strtoupper(
                sha1(
                    $this->appId
                    . strtoupper(md5($transaction_id . $this->timestamp))
                    . strtoupper(
                        sha1(
                            $this->appSecret . $customer_id
                        )
                    )
                )
            )
        );
        $personalParams = [
            //业务参数
            'transaction_id' => $transaction_id,
            'contract_id' => $contract_id,
            'customer_id' => $customer_id,
            'client_role' => $client_role,
            'position_type' => $position_type,
            'sign_keyword' => $sign_keyword,
            'doc_title' => $doc_title,
            'keyword_strategy' => $keyword_strategy,
            'notify_url' => $notify_url
        ];
        $params = array_merge($this->getCommonParams($msg_digest), $personalParams);
        $url = $this->baseUrl . UrlConfig::EXTSIGN_AUTO;
        return $this->curl->post($url, $params);
    }

    /**
     * 手动签署
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:extSign
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 10:19
     * Email:1695699447@qq.com
     * @param        $transaction_id :交易编号
     * @param        $contract_id    :合同编号
     * @param        $customer_id    :客户
     * @param        $doc_title      :文档标题
     * @param string $return_url     :页面跳转URL（签署结果同步通知）
     * @param string $sign_keyword
     * @param string $notify_url     :页面跳转URL（签署结果异步通知
     * @return string
     */
    public function extSign($transaction_id, $contract_id, $customer_id, $doc_title, $return_url = '', $sign_keyword = '', $notify_url = ''): string
    {
        $msg_digest = base64_encode(
            strtoupper(
                sha1(
                    $this->appId
                    . strtoupper(md5($transaction_id . $this->timestamp))
                    . strtoupper(
                        sha1(
                            $this->appSecret . $customer_id
                        )
                    )
                )
            )
        );
        $params = $this->getCommonParams($msg_digest) + [
                //业务参数
                'transaction_id' => $transaction_id,
                'contract_id' => $contract_id,
                'customer_id' => $customer_id,
                'doc_title' => $doc_title,
                'return_url' => $return_url,
                'notify_url' => $notify_url,
                'sign_keyword' => $sign_keyword,
            ];
        $url = $this->baseUrl . UrlConfig::EXT_SIGN;
        return $url . '?' . http_build_query($params);
    }

    /**
     * 查看合同
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:viewContract
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 11:24
     * Email:1695699447@qq.com
     * @param string $contract_id :合同编号
     * @return string
     */
    public function viewContract(string $contract_id)
    {
        $params = $this->getParams(compact('contract_id'));
        $url = $this->baseUrl . UrlConfig::VIEW_CONTRACT;
        return $this->curl->post($url, $params);
    }

    /**
     * 合同下载
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:downLoadContract
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 11:41
     * Email:1695699447@qq.com
     * @param string $contract_id :合同编号
     * @param null   $return_url  :下载链接或者内容
     * @return string|null
     */
    public function downLoadContract(string $contract_id, $return_url = null)
    {
        $params = $this->getParams(compact('contract_id'));
        $url = $this->baseUrl . UrlConfig::DOWNLOAD_CONTRACT;
        return $return_url ? $url . '?' . http_build_query($params) : $this->curl->post($url, $params);
    }

    /**
     * 合同归档
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:contractFiling
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 11:45
     * Email:1695699447@qq.com
     * @param $contract_id :合同编号
     * @return mixed
     */
    public function contractFiling($contract_id)
    {
        $params = $this->getParams(compact('contract_id'));
        $url = $this->baseUrl . UrlConfig::CONTRACT_FILING;
        return $this->curl->post($url, $params);
    }


    /**
     * 通过uuid下载
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:getFile
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 11:48
     * Email:1695699447@qq.com
     * @param      $uuid       :uuid
     * @param null $return_url :下载链接或者内容
     * @return string|null
     */
    public function getFile($uuid, $return_url = null)
    {
        $params = $this->getParams(compact('uuid'));
        $url = $this->baseUrl . UrlConfig::GET_FILE;
        return $return_url ? $url . '?' . http_build_query($params) : $this->curl->post($url, $params);
    }

    /**
     * 查询个人实名认证
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:findPersonCertInfo
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 14:16
     * Email:1695699447@qq.com
     * @param $verified_serialno :交易号，获取认证地址时返回
     * @return array
     */
    public function findPersonCertInfo($verified_serialno)
    {
        $params = $this->getParams(compact('verified_serialno'));
        $url = $this->baseUrl . UrlConfig::FIND_PERSON_CERT_INFO;
        return $this->curl->post($url, $params);
    }

    /**
     * 查询企业实名认证信息
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:findCompanyCertInfo
     * status:
     * User: Mr.liang
     * Date: 2021/4/21
     * Time: 14:15
     * Email:1695699447@qq.com
     * @param $verified_serialno :交易号，获取认证地址时返回
     * @return array
     */
    public function findCompanyCertInfo($verified_serialno)
    {
        $params = $this->getParams(compact('verified_serialno'));
        $url = $this->baseUrl . UrlConfig::FIND_COMPANY_CERT_INFO;
        return $this->curl->post($url, $params);
    }

    /**
     * 自动签署授权
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:beforeAuthsign
     * status:
     * User: Mr.liang
     * Date: 2021/4/24
     * Time: 10:16
     * Email:1695699447@qq.com
     * @param        $transaction_id
     * @param        $contract_id
     * @param        $customer_id
     * @param string $return_url
     * @param string $notify_url
     * @param int    $auth_type
     * @return string
     */
    public function beforeAuthsign($transaction_id, $contract_id, $customer_id, $return_url , $notify_url , $auth_type = 1)
    {
        $msg_digest = base64_encode(
            strtoupper(
                sha1(
                    $this->appId
                    . strtoupper(md5($transaction_id . $this->timestamp))
                    . strtoupper(
                        sha1(
                            $this->appSecret . $customer_id
                        )
                    )
                )
            )
        );
        $data = [
            //业务参数
            'transaction_id' => $transaction_id,
            'contract_id' => $contract_id,
            'customer_id' => $customer_id,
            'return_url' => $return_url,
            'notify_url' => $notify_url,
            'auth_type' => $auth_type,
        ];
        ksort($data, 1);
        $params = $this->getCommonParams($msg_digest) + $data;
        $url = $this->baseUrl . UrlConfig::BEFORE_AUTHSIGN;
        return $url . '?' . http_build_query($params);
    }

    /**
     * 查询授权自动签状态接口
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:getAuthStatus
     * status:
     * User: Mr.liang
     * Date: 2021/4/24
     * Time: 10:18
     * Email:1695699447@qq.com
     * @param $customer_id
     * @return mixed
     */
    public function getAuthStatus($customer_id)
    {
        $params = $this->getParams(compact('customer_id'));
        $url = $this->baseUrl . UrlConfig::GET_AUTH_STATUS;
        return $this->curl->post($url, $params);
    }

    /**
     * 取消自动签字授权
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:cancelExtsignAutoPage
     * status:
     * User: Mr.liang
     * Date: 2021/4/24
     * Time: 16:14
     * Email:1695699447@qq.com
     * @param $customer_id
     * @return string
     */
    public function cancelExtsignAutoPage($customer_id)
    {
        $params = $this->getParams(compact('customer_id'));
        $url = $this->baseUrl . UrlConfig::CANCEL_EXTSIGN_AUTO_PAGE;
        return $url . '?' . http_build_query($params);
    }

    /**
     * 快捷签署接口（个人）
     * Created by Mr.亮先生.
     * program: Fdd
     * FuncName:personVerifySign
     * status:
     * User: Mr.liang
     * Date: 2021/4/24
     * Time: 16:04
     * Email:1695699447@qq.com
     * @param     $transaction_id
     * @param     $contract_id
     * @param     $customer_id
     * @param     $return_url
     * @param     $notify_url
     * @param     $verified_notify_url
     * @param int $verified_way
     * @param int $page_modify
     * @return mixed
     */
    public function personVerifySign($transaction_id, $contract_id, $customer_id, $return_url, $notify_url, $verified_notify_url, $verified_way = 0, $page_modify = 1)
    {
        $params = $this->getParams(compact('transaction_id', 'contract_id', 'customer_id', 'return_url', 'notify_url', 'verified_notify_url', 'verified_way', 'page_modify'));
        $url = $this->baseUrl . UrlConfig::PERSON_VERIFY_SIGN;
        return $this->curl->post($url, $params);
    }

    private function getParams($personal)
    {
        $msg_digest = $this->getMsgDigest($personal);
        $common = $this->getCommonParams($msg_digest);
        $params = array_merge($common, $personal);
        return $params;
    }

    private function getMsgDigest(array $data, string $parameter_map = ''): string
    {
        if (!empty($parameter_map) && isset($parameter_map)) {
            $ascllSort = $data['template_id'] . $data['contract_id'];
        } else {
            $ascllSort = $this->ascllSort($data);
        }
        return base64_encode(
            strtoupper(
                sha1(
                    $this->appId
                    . strtoupper(md5($this->timestamp))
                    . strtoupper(
                        sha1(
                            $this->appSecret . $ascllSort
                        )
                    )
                    . $parameter_map
                )
            )
        );
    }

    private function getCommonParams(string $msg_digest): array
    {
        return [
            //公共参数
            'app_id' => $this->appId,
            'timestamp' => $this->timestamp,
            'v' => $this->version,
            'msg_digest' => $msg_digest,
        ];
    }

    private function ascllSort($arr, $sorting_type = 0): string
    {
        ksort($arr, $sorting_type);
        return implode('', $arr);
    }

    private function getImageToBase64(string $file_path): string
    {
        if (is_file($file_path)) {
            return base64_encode(file_get_contents($file_path));
        }
        $url = parse_url($file_path);
        if (isset($url['scheme']) && in_array($url['scheme'], ['http', 'https'])) {
            return base64_encode(file_get_contents($file_path));
        }
        throw new UnexpectedValueException('文件不存在');
    }
}

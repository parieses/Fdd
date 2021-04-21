<?php


namespace Fdd;


class Code
{
    /**
     * error code 公共错误码.
     * <ul>
     *    <li>-1: 未知异常信息 抱歉,暂时无法处理您的请求,请稍后再试</li>
     *    <li>0: 失败(有时候会带上具体原因)</li>
     *    <li>1: 成功</li>
     *    <li>2: 重复请求</li>
     *    <li>-41016: base64解密失败</li>
     * </ul>
     */
    public static $UNKNOWN_EXCEPTION = -1;
    public static $ERROR = 0;
    public static $SUCCESS = 1;
    public static $REPEAT_REQUEST = 2;
    public static $ILLEGAL_PUBLIC_PARAMETERS = 1001;
    public static $APP_ID_ERROR = 1002;
    public static $MSG_DIGEST_ERROR = 1003;
    public static $ILLEGAL_REQUEST_PARAMETER = 1004;
    public static $IP_ERROR = 1005;
    public static $FREQUENT_REQUESTS =  1006;


    public static $IllegalIv = -41002;
    public static $IllegalBuffer = -41003;
    public static $DecodeBase64Error = -41004;
}
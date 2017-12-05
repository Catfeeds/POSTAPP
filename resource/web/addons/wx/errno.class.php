<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class ERRNO
{
	const OK = 0;
	const SYSTEM_ERROR = 1;
	const PARAM_ERROR = 2;
	const INVALID_REQUEST = 3;
	const NOT_LOGIN = 4;
	const NOT_IN_WECHAT = 5;
	const UNSUBSCRIBE_NOT_EXCHANGE = 6;
	const NICKANME_NULL = 100;
	const NICKANME_INVALID = 101;
	const MOBILE_NULL = 102;
	const MOBILE_INVALID = 103;
	const MOBILE_EXISTS = 104;
	const EMAIL_NULL = 105;
	const EMAIL_INVALID = 106;
	const EMAIL_EXISTS = 107;
	const USERNAME_NULL = 108;
	const CITY_NULL = 109;
	const CITY_INVALID = 110;
	const TASK_NOT_BEGIN = 1000;
	const TASK_END = 1001;
	const TASK_NO_FOUND = 1002;
	const TASK_LIMIT_OUT = 1003;
	const TASK_NO_BIND = 1004;
	const TASK_NOT_BINDING = 1005;
	const TASK_FINISH = 1006;
	const TASK_NO_FINISH = 1007;
	const TASK_MEMBER_GROUP_LIMIT = 1008;
	const PRODUCT_NOT_FOUND = 2000;
	const PRODUCT_EXCHANGE_NOT_BEGIN = 2001;
	const PRODUCT_EXCHANGE_END = 2002;
	const PRODUCT_EXCHANGE_LIMIT = 2003;
	const PRODUCT_NOT_TOTAL = 2004;
	const PRODUCT_DISPATCH_NOT_FOUND = 2005;
	const PRODUCT_OFFLINE = 2006;
	const PRODUCT_GROUP_LIMIT = 2007;
	const CREDIT_NOT_ENOUGH = 3000;
	const CREDIT_BALANCE_NOT_ENOUGH = 3001;
	const ORDER_NOT_PAY = 4000;
	const ORDER_EXIST_NOT_PAY = 4001;
	const ORDER_NOT_EXIST = 4002;
	const ORDER_NOT_NEED_PAY = 4003;
	const ORDER_NOT_FOUND_PAYTYPE = 4004;
	const ORDER_PAYED = 4005;
	const ORDER_RETURN_CREDIT_FAILED = 4006;
	const ORDER_CANNOT_CHECKOUT = 4007;
	const ORDER_HAD_CHECKOUT = 4008;
	const ADDRESS_NULL = 5000;
	const ADDRESS_INVALID = 5001;
	const ADDRESS_NOT_EXIST = 5002;
	const AUCTION_NOT_START = 6000;
	const AUCTION_HAS_ENDED = 6001;
	const AUCTION_CREDIT_INVALID = 6002;
	const CODE_NOT_EXIST = 7000;
	const CODE_CANT_USE = 7001;
	public static $ERRMSG = array(self::OK => 'ok', self::SYSTEM_ERROR => '系统错误', self::PARAM_ERROR => '参数错误', self::INVALID_REQUEST => '非法请求', self::NOT_LOGIN => '未登录，跳转中...', self::NOT_IN_WECHAT => '请使用微信访问', self::UNSUBSCRIBE_NOT_EXCHANGE => '未关注公众号，无法兑换', self::NICKANME_NULL => '请输入昵称', self::NICKANME_INVALID => '请输入合法昵称', self::MOBILE_NULL => '请输入手机号', self::MOBILE_INVALID => '请输入合法手机号', self::MOBILE_EXISTS => '手机号已存在，请更换', self::EMAIL_NULL => '请输入邮箱', self::EMAIL_INVALID => '请输入合法邮箱', self::EMAIL_EXISTS => '邮箱已存在，请更换', self::USERNAME_NULL => '请输入姓名', self::CITY_NULL => '请选择城市', self::CITY_INVALID => '城市信息非法', self::TASK_NOT_BEGIN => '任务未开始', self::TASK_END => '任务已结束', self::TASK_NO_FOUND => '任务不存在或已删除', self::TASK_LIMIT_OUT => '已超过任务申请次数', self::TASK_NO_BIND => '未设置任务模块链接', self::TASK_NOT_BINDING => '任务未绑定活动', self::TASK_FINISH => '任务已完成', self::TASK_NO_FINISH => '任务未完成，跳转中...', self::TASK_MEMBER_GROUP_LIMIT => '会员组限制', self::PRODUCT_NOT_FOUND => '商品不存在或已删除', self::PRODUCT_EXCHANGE_NOT_BEGIN => '兑换未开始', self::PRODUCT_EXCHANGE_END => '兑换已结束', self::PRODUCT_EXCHANGE_LIMIT => '超过兑换限制', self::PRODUCT_NOT_TOTAL => '已被抢光', self::PRODUCT_DISPATCH_NOT_FOUND => '配送数据不存在', self::PRODUCT_OFFLINE => '已下架', self::PRODUCT_GROUP_LIMIT => '会员组兑换限制', self::CREDIT_NOT_ENOUGH => '积分不足', self::CREDIT_BALANCE_NOT_ENOUGH => '余额不足', self::ORDER_NOT_PAY => '订单未支付', self::ORDER_EXIST_NOT_PAY => '存在未支付订单，跳转中...', self::ORDER_NOT_EXIST => '订单不存在或已删除', self::ORDER_NOT_NEED_PAY => '订单已付款或已取消', self::ORDER_NOT_FOUND_PAYTYPE => '支付方式错误', self::ORDER_PAYED => '订单已支付', self::ORDER_RETURN_CREDIT_FAILED => '退积分失败', self::ORDER_CANNOT_CHECKOUT => '订单无法核销', self::ORDER_HAD_CHECKOUT => '订单已核销', self::ADDRESS_NULL => '请添加收货地址，跳转中...', self::ADDRESS_INVALID => '收货地址不合法', self::ADDRESS_NOT_EXIST => '地址不存在或已删除', self::AUCTION_NOT_START => '竞拍未开始', self::AUCTION_HAS_ENDED => '竞拍已结束', self::AUCTION_CREDIT_INVALID => '出价不合法', self::CODE_NOT_EXIST => '验证码有误，请重新输入', self::CODE_CANT_USE => '该验证码不适用于本商品的核销');
}
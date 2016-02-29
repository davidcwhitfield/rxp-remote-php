<?php


namespace com\realexpayments\remote\sdk\utils;

use com\realexpayments\remote\sdk\domain\CardType;
use com\realexpayments\remote\sdk\domain\payment\AddressType;
use com\realexpayments\remote\sdk\domain\payment\AutoSettleFlag;
use com\realexpayments\remote\sdk\domain\payment\PaymentRequest;
use com\realexpayments\remote\sdk\domain\payment\PaymentResponse;
use com\realexpayments\remote\sdk\domain\payment\PaymentType;
use com\realexpayments\remote\sdk\domain\payment\RecurringFlag;
use com\realexpayments\remote\sdk\domain\payment\RecurringSequence;
use com\realexpayments\remote\sdk\domain\payment\RecurringType;
use com\realexpayments\remote\sdk\domain\PresenceIndicator;
use com\realexpayments\remote\sdk\domain\threeDSecure\ThreeDSecureRequest;
use com\realexpayments\remote\sdk\domain\threeDSecure\ThreeDSecureResponse;
use com\realexpayments\remote\sdk\domain\threeDSecure\ThreeDSecureType;
use com\realexpayments\remote\sdk\RealexServerException;
use PHPUnit_Framework_TestCase;

class SampleXmlValidationUtils {

	const SECRET = "mysecret";

	//payment sample XML
	const PAYMENT_REQUEST_XML_PATH = "/sample-xml/payment-request-sample.xml";
	const PAYMENT_RESPONSE_XML_PATH = "/sample-xml/payment-response-sample.xml";
	const PAYMENT_RESPONSE_BASIC_ERROR_XML_PATH = "/sample-xml/payment-response-basic-error-sample.xml";
	const PAYMENT_RESPONSE_FULL_ERROR_XML_PATH = "/sample-xml/payment-response-full-error-sample.xml";
	const PAYMENT_RESPONSE_XML_PATH_UNKNOWN_ELEMENT = "/sample-xml/payment-response-sample-unknown-element.xml";
	const PAYMENT_REQUEST_WITH_SYMBOLS_XML_PATH = "/sample-xml/payment-request-sample-with-symbols.xml";

	//3DSecure sample XML
	const THREE_D_SECURE_VERIFY_ENROLLED_REQUEST_XML_PATH = "/sample-xml/3ds-verify-enrolled-request-sample.xml";
	const THREE_D_SECURE_VERIFY_ENROLLED_RESPONSE_XML_PATH = "/sample-xml/3ds-verify-enrolled-response-sample.xml";
	const THREE_D_SECURE_VERIFY_ENROLLED_NOT_ENROLLED_RESPONSE_XML_PATH = "/sample-xml/3ds-verify-enrolled-response-sample-not-enrolled.xml";
	const THREE_D_SECURE_VERIFY_SIG_REQUEST_XML_PATH = "/sample-xml/3ds-verify-sig-request-sample.xml";
	const THREE_D_SECURE_VERIFY_SIG_RESPONSE_XML_PATH = "/sample-xml/3ds-verify-sig-response-sample.xml";

	//mobile auth payment sample XML
	const MOBILE_AUTH_PAYMENT_REQUEST_XML_PATH = "/sample-xml/auth-mobile-payment-request-sample.xml";

	//other request types sample XML
	const SETTLE_PAYMENT_REQUEST_XML_PATH = "/sample-xml/settle-payment-request-sample.xml";
	const VOID_PAYMENT_REQUEST_XML_PATH = "/sample-xml/void-payment-request-sample.xml";
	const REBATE_PAYMENT_REQUEST_XML_PATH = "/sample-xml/rebate-payment-request-sample.xml";
	const OTB_PAYMENT_REQUEST_XML_PATH = "/sample-xml/otb-payment-request-sample.xml";
	const CREDIT_PAYMENT_REQUEST_XML_PATH = "/sample-xml/credit-payment-request-sample.xml";
	const HOLD_PAYMENT_REQUEST_XML_PATH = "/sample-xml/hold-payment-request-sample.xml";
	const RELEASE_PAYMENT_REQUEST_XML_PATH = "/sample-xml/release-payment-request-sample.xml";


	//Card
	const CARD_NUMBER = "420000000000000000";
	/**
	 * @var CardType
	 */
	static $CARD_TYPE;

	const CARD_HOLDER_NAME = "Joe Smith";
	const  CARD_CVN_NUMBER = "123";
	/**
	 * @var PresenceIndicator
	 */
	public static $CARD_CVN_PRESENCE;
	const CARD_EXPIRY_DATE = "0119";
	const CARD_ISSUE_NUMBER = 1;

	//PaymentRequest
	const ACCOUNT = "internet";
	const MERCHANT_ID = "thestore";
	const AMOUNT = 29900;
	const CURRENCY = "EUR";
	/**
	 * @var AutoSettleFlag
	 */
	static $AUTO_SETTLE_FLAG;
	const TIMESTAMP = "20151201094345";
	const CHANNEL = "yourChannel";
	const ORDER_ID = "ORD453-11";
	const REQUEST_HASH = "085f09727da50c2392b64894f962e7eb5050f762";
	const COMMENT1 = "comment 1";
	const COMMENT2 = "comment 2";
	const COMMENT1_WITH_SYMBOLS = "a-z A-Z 0-9 ' \", + “” ._ - & \\ / @ ! ? % ( )* : £ $ & € # [ ] | = ;ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷ø¤ùúûüýþÿŒŽšœžŸ¥";
	const COMMENT2_WITH_SYMBOLS = "comment 2 £";
	const REFUND_HASH = "hjfdg78h34tyvklasjr89t";
	const FRAUD_FILTER = "fraud filter";
	const CUSTOMER_NUMBER = "cust num";
	const CUSTOMER_NUMBER_WITH_SYMBOLS = "cust num $ £";
	const PRODUCT_ID = "prod ID";
	const VARIABLE_REFERENCE = "variable ref 1234";
	const VARIABLE_REFERENCE_WITH_SYMBOLS = "variable ref 1234 $$ ££";
	const CUSTOMER_IP = "127.0.0.1";

	//Recurring
	/**
	 * @var RecurringType
	 */
	public static $RECURRING_TYPE;

	/**
	 * @var RecurringFlag
	 */
	public static $RECURRING_FLAG;

	/**
	 * @var RecurringSequence
	 */
	public static $RECURRING_SEQUENCE;

	//Address
	/**
	 * @var AddressType
	 */
	public static $ADDRESS_TYPE_BUSINESS;
	const ADDRESS_CODE_BUSINESS = "21|578";
	const ADDRESS_COUNTRY_BUSINESS = "IE";

	/**
	 * @var AddressType
	 */
	public static $ADDRESS_TYPE_SHIPPING;
	const ADDRESS_CODE_SHIPPING = "77|9876";
	const ADDRESS_COUNTRY_SHIPPING = "GB";

	/**
	 * @var AutoSettleFlag
	 */
	static $AUTH_MOBILE_AUTO_SETTLE_FLAG;

	/**
	 * @var AutoSettleFlag
	 */
	static $OTB_AUTO_SETTLE_FLAG;

	//response fields
	const ACQUIRER_RESPONSE = "<response>test acquirer response</response>";
	const AUTH_TIME_TAKEN = 1001;
	const BATCH_ID = - 1;
	const BANK = "bank";
	const COUNTRY = "Ireland";
	const COUNTRY_CODE = "IE";
	const REGION = "Dublin";
	const CVN_RESULT = "M";
	const MESSAGE = "Successful";
	const RESULT_SUCCESS = "00";
	const TIME_TAKEN = 54564;
	const TSS_RESULT = "67";
	const TSS_RESULT_CHECK1_ID = "1";
	const TSS_RESULT_CHECK2_ID = "2";
	const TSS_RESULT_CHECK1_VALUE = "99";
	const TSS_RESULT_CHECK2_VALUE = "199";
	const RESPONSE_HASH = "368df010076481d47a21e777871012b62b976339";
	const PASREF = "3737468273643";
	const AUTH_CODE = "79347";
	const AVS_POSTCODE = "M";
	const AVS_ADDRESS = "P";
	const MOBILE = "apple-pay";
	const TIMESTAMP_RESPONSE = "20120926112654";

	//basic response error fields
	const MESSAGE_BASIC_ERROR = "error message returned from system";
	const RESULT_BASIC_ERROR = "508";
	const TIMESTAMP_BASIC_ERROR = "20120926112654";
	const ORDER_ID_BASIC_ERROR = "ORD453-11";

	//basic response error fields
	const RESULT_FULL_ERROR = "101";
	const MESSAGE_FULL_ERROR = "Bank Error";
	const RESPONSE_FULL_ERROR_HASH = "0ad8a9f121c4041b4b832ae8069e80674269e22f";

	//3DS request fields
	const THREE_D_SECURE_VERIFY_ENROLLED_REQUEST_HASH = "085f09727da50c2392b64894f962e7eb5050f762";
	const THREE_D_SECURE_VERIFY_SIG_REQUEST_HASH = "085f09727da50c2392b64894f962e7eb5050f762";

	//3DS response fields
	const THREE_D_SECURE_ENROLLED_RESULT = "00";
	const THREE_D_SECURE_SIG_RESULT = "00";
	const THREE_D_SECURE_NOT_ENROLLED_RESULT = "110";
	const THREE_D_SECURE_ENROLLED_MESSAGE = "Enrolled";
	const THREE_D_SECURE_SIG_MESSAGE = "Authentication Successful";
	const THREE_D_SECURE_NOT_ENROLLED_MESSAGE = "Not Enrolled";
	const THREE_D_SECURE_PAREQ = "eJxVUttygkAM/ZUdnitZFlBw4na02tE6bR0vD+0bLlHpFFDASv++u6i1";
	const THREE_D_SECURE_PARES = "eJxVUttygkAM/ZUdnitZFlBw4na02tE6bR0vD+0bLlHpFFDASv++u6i1";
	const THREE_D_SECURE_URL = "http://myurl.com";
	const THREE_D_SECURE_ENROLLED_NO = "N";
	const THREE_D_SECURE_ENROLLED_YES = "Y";
	const THREE_D_SECURE_STATUS = "Y";
	const THREE_D_SECURE_ECI = "5";
	const THREE_D_SECURE_XID = "e9dafe706f7142469c45d4877aaf5984";
	const THREE_D_SECURE_CAVV = "AAABASY3QHgwUVdEBTdAAAAAAAA=";
	const THREE_D_SECURE_ALGORITHM = "1";
	const THREE_D_SECURE_NOT_ENROLLED_RESPONSE_HASH = "e553ff2510dec9bfee79bb0303af337d871c02ad";
	const THREE_D_SECURE_ENROLLED_RESPONSE_HASH = "728cdbef90ff535ed818748f329ed8b1df6b8f5a";
	const THREE_D_SECURE_SIG_RESPONSE_HASH = "e5a7745da5dc32d234c3f52860132c482107e9ac";

	// auth-mobile fields
	const AUTH_MOBILE_TIMESTAMP = "20150820154047";
	const AUTH_MOBILE_TYPE = "AUTH_MOBILE";
	const AUTH_MOBILE_MERCHANT_ID = "thestore";
	const AUTH_MOBILE_ACCOUNT = "internet";
	const AUTH_MOBILE_ORDER_ID = "8cdbf036-73e2-44ff-bf11-eba8cab33a14";
	const AUTH_MOBILE_MOBILE = "apple-pay";
	const AUTH_MOBILE_TOKEN = "{\"version\":\"EC_v1\",\"data\":\"Ft+dvmdfgnsdfnbg+zerKtkh/RWWjdfgdjhHGFHGFlkjdfgkljlkfs78678hEPnsbXZnMDy3o7qDg+iDHB0JVEjDHxjQIAPcNN1Cqdtq63nX4+VRU3eXzdo1QGqSptH6D5KW5SxZLAdnMEmCxG9vkVEdHTTlhVPddxiovAkFTBWBFTJ2uf5f2grXC/VnK0X/efAowXrhJIX1ngsGfAk3/EVRzADGHJFGHJKH78hjkhdfgih80UU05zSluzATidvvBoHBz/WpytSYyrUx1QI9nyH/Nbv8f8lOUjPzBFb+EFOzJaIf+fr0swKU6EB2/2Sm0Y20mD0IvyomtKQ7Tf3VHKA7zhFrDvZUdtX808oHnrqDFRAQZHWAppGUVstqkOyibA0C4suxnOQlsQNZT0r70Tz84=\",\"signature\":\"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\",\"header\":{\"ephemeralPublicKey\":\"MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEWdNhNAHy9kO2Kol33kIh7k6wh6E/lxriM46MR1FUrn7SHugprkaeFmWKZPgGpWgZ+telY/G1+YSoaCbR57bdGA==\",\"transactionId\":\"fd88874954acdb29976gfnjd784ng8ern8BDF8gT7G3fd4ebc22a864398684198644c3\",\"publicKeyHash\":\"h7njghUJVz2gmpTSkHqETOWsskhsdfjj4mgf3sPTS2cBxgrk=\"}}";
	const AUTH_MOBILE_REQUEST_HASH = "b13f183cd3ea2a0b63033fb53bdeb4894c684643";

	//settle fields
	const SETTLE_TIMESTAMP = "20151204133035";
	const SETTLE_MERCHANT_ID = "thestore";
	const SETTLE_ACCOUNT = "internet";
	const SETTLE_PASREF = "13276780809850";
	const SETTLE_AUTH_CODE = "AP1234";
	const SETTLE_AMOUNT = "1000";
	const SETTLE_CURRENCY = "EUR";
	const SETTLE_ORDER_ID = "e3cf94c6-f674-4f99-b4db-7541254a8767";
	const SETTLE_REQUEST_HASH = "b2e110f78803ccb377e8f3f12730e41d0cb0ed66";

	//void fields
	const VOID_TIMESTAMP = "20151204142728";
	const VOID_MERCHANT_ID = "thestore";
	const VOID_ACCOUNT = "internet";
	const VOID_PASREF = "13276780809851";
	const VOID_AUTH_CODE = "AP12345";
	const VOID_ORDER_ID = "012bf34b-3ec9-4c9b-b3a5-700f2f28e67f";
	const VOID_REQUEST_HASH = "9f61456cce6c90dcc13281e6b95734f5b91e628f";

	//rebate fields
	const REBATE_TIMESTAMP = "20151204145825";
	const REBATE_MERCHANT_ID = "thestore";
	const REBATE_ACCOUNT = "internet";
	const REBATE_PASREF = "13276780809852";
	const REBATE_AUTH_CODE = "AP12346";
	const REBATE_AMOUNT = "3000";
	const REBATE_CURRENCY = "EUR";
	const REBATE_ORDER_ID = "6df026a7-15d6-4b92-86e1-9f7b2b1d97c5";
	const REBATE_REFUND_HASH = "52ed08590ab0bb6c2e5e4c9584aca0f6e9635a3a";
	const REBATE_REQUEST_HASH = "c1319b2999608fcfa3e71d583627affaeb25d961";

	//OTB fields
	const OTB_ACCOUNT = "internet";
	const OTB_MERCHANT_ID = "thestore";
	const OTB_TIMESTAMP = "20151204152333";
	const OTB_ORDER_ID = "3be87fe9-db95-470f-ab04-b82f965f5b17";
	const OTB_REQUEST_HASH = "c05460fa3d195c1ee6ac97d3594e8cace4449cb2";

	//credit fields
	const CREDIT_TIMESTAMP = "20151204145825";
	const CREDIT_MERCHANT_ID = "thestore";
	const CREDIT_ACCOUNT = "internet";
	const CREDIT_PASREF = "13276780809852";
	const CREDIT_AUTH_CODE = "AP12346";
	const CREDIT_AMOUNT = "3000";
	const CREDIT_CURRENCY = "EUR";
	const CREDIT_ORDER_ID = "6df026a7-15d6-4b92-86e1-9f7b2b1d97c5";
	const CREDIT_REFUND_HASH = "52ed08590ab0bb6c2e5e4c9584aca0f6e9635a3a";
	const CREDIT_REQUEST_HASH = "c1319b2999608fcfa3e71d583627affaeb25d961";

	//hold fields
	const HOLD_TIMESTAMP = "20151204161419";
	const HOLD_MERCHANT_ID = "thestore";
	const HOLD_ACCOUNT = "internet";
	const HOLD_PASREF = "ABC123456";
	const HOLD_ORDER_ID = "292af5fa-6cbc-43d5-b2f0-7fd134d78d95";
	const HOLD_REQUEST_HASH = "eec6d1f5dcc51a6a2d2b59af5d2cdb965806d96c";

	//release fields
	const RELEASE_TIMESTAMP = "20151204161419";
	const RELEASE_MERCHANT_ID = "thestore";
	const RELEASE_ACCOUNT = "internet";
	const RELEASE_PASREF = "ABC123456";
	const RELEASE_ORDER_ID = "292af5fa-6cbc-43d5-b2f0-7fd134d78d95";
	const RELEASE_REQUEST_HASH = "eec6d1f5dcc51a6a2d2b59af5d2cdb965806d96c";

	static function Init() {
		self::$CARD_CVN_PRESENCE            = new PresenceIndicator( PresenceIndicator::CVN_PRESENT );
		self::$ADDRESS_TYPE_BUSINESS        = new AddressType( AddressType::BILLING );
		self::$ADDRESS_TYPE_SHIPPING        = new AddressType( AddressType::SHIPPING );
		self::$AUTO_SETTLE_FLAG             = new AutoSettleFlag( AutoSettleFlag::MULTI );
		self::$CARD_TYPE                    = new CardType( CardType::VISA );
		self::$RECURRING_TYPE               = new RecurringType( RecurringType::FIXED );
		self::$RECURRING_FLAG               = new RecurringFlag( RecurringFlag::ONE );
		self::$RECURRING_SEQUENCE           = new RecurringSequence( RecurringSequence::FIRST );
		self::$AUTH_MOBILE_AUTO_SETTLE_FLAG = new AutoSettleFlag( AutoSettleFlag::TRUE );
		self::$OTB_AUTO_SETTLE_FLAG         = new AutoSettleFlag( AutoSettleFlag::TRUE );
	}

	/**
	 *  Check all fields match expected values.
	 *
	 * @param PaymentResponse $fromXmlResponse
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledPaymentResponse( PaymentResponse $fromXmlResponse, PHPUnit_Framework_TestCase $testCase, $ignoreTssChecks = false ) {

		$testCase->assertEquals( self::ACCOUNT, $fromXmlResponse->getAccount() );
		$testCase->assertEquals( self::ACQUIRER_RESPONSE, $fromXmlResponse->getAcquirerResponse() );
		$testCase->assertEquals( self::AUTH_CODE, $fromXmlResponse->getAuthCode() );
		$testCase->assertEquals( self::AUTH_TIME_TAKEN, $fromXmlResponse->getAuthTimeTaken() );
		$testCase->assertEquals( self::BATCH_ID, $fromXmlResponse->getBatchId() );
		$testCase->assertEquals( self::BANK, $fromXmlResponse->getCardIssuer()->getBank() );
		$testCase->assertEquals( self::COUNTRY, $fromXmlResponse->getCardIssuer()->getCountry() );
		$testCase->assertEquals( self::COUNTRY_CODE, $fromXmlResponse->getCardIssuer()->getCountryCode() );
		$testCase->assertEquals( self::REGION, $fromXmlResponse->getCardIssuer()->getRegion() );
		$testCase->assertEquals( self::CVN_RESULT, $fromXmlResponse->getCvnResult() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlResponse->getMerchantId() );
		$testCase->assertEquals( self::MESSAGE, $fromXmlResponse->getMessage() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlResponse->getOrderId() );
		$testCase->assertEquals( self::PASREF, $fromXmlResponse->getPaymentsReference() );
		$testCase->assertEquals( self::RESULT_SUCCESS, $fromXmlResponse->getResult() );
		$testCase->assertEquals( self::RESPONSE_HASH, $fromXmlResponse->getHash() );
		$testCase->assertEquals( self::TIMESTAMP_RESPONSE, $fromXmlResponse->getTimeStamp() );
		$testCase->assertEquals( self::TIME_TAKEN, $fromXmlResponse->getTimeTaken() );
		$testCase->assertEquals( self::TSS_RESULT, $fromXmlResponse->getTssResult()->getResult() );

		if ( ! $ignoreTssChecks ) {
			$checks = $fromXmlResponse->getTssResult()->getChecks();
			$testCase->assertEquals( self::TSS_RESULT_CHECK1_ID, $checks[0]->getId() );
			$testCase->assertEquals( self::TSS_RESULT_CHECK1_VALUE, $checks[0]->getValue() );
			$testCase->assertEquals( self::TSS_RESULT_CHECK2_ID, $checks[1]->getId() );
			$testCase->assertEquals( self::TSS_RESULT_CHECK2_VALUE, $checks[1]->getValue() );
		}

		$testCase->assertEquals( self::AVS_ADDRESS, $fromXmlResponse->getAvsAddressResponse() );
		$testCase->assertEquals( self::AVS_POSTCODE, $fromXmlResponse->getAvsPostcodeResponse() );
		$testCase->assertTrue( $fromXmlResponse->isSuccess() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledPaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::AUTH, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::CARD_NUMBER, $fromXmlRequest->getCard()->getNumber() );

		$testCase->assertEquals( self::$CARD_TYPE->getType(), $fromXmlRequest->getCard()->getType() );
		$testCase->assertEquals( self::CARD_HOLDER_NAME, $fromXmlRequest->getCard()->getCardHolderName() );
		$testCase->assertEquals( self::CARD_CVN_NUMBER, $fromXmlRequest->getCard()->getCvn()->getNumber() );
		$testCase->assertEquals( self::$CARD_CVN_PRESENCE->getIndicator(), $fromXmlRequest->getCard()->getCvn()->getPresenceIndicator() );
		$testCase->assertEquals( self::CARD_ISSUE_NUMBER, $fromXmlRequest->getCard()->getIssueNumber() );
		$testCase->assertEquals( self::CARD_EXPIRY_DATE, $fromXmlRequest->getCard()->getExpiryDate() );

		$testCase->assertEquals( self::ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( PaymentType::AUTH, $fromXmlRequest->getType() );
		$testCase->assertEquals( self:: AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::$AUTO_SETTLE_FLAG->getFlag(), $fromXmlRequest->getAutoSettle()->getFlag() );
		$testCase->assertEquals( self::TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::CHANNEL, $fromXmlRequest->getChannel() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::COMMENT1, $fromXmlRequest->getComments()->get( 0 )->getComment() );
		$testCase->assertEquals( "1", $fromXmlRequest->getComments()->get( 0 )->getId() );
		$testCase->assertEquals( self::COMMENT2, $fromXmlRequest->getComments()->get( 1 )->getComment() );
		$testCase->assertEquals( "2", $fromXmlRequest->getComments()->get( 1 )->getId() );
		$testCase->assertEquals( self::PASREF, $fromXmlRequest->getPaymentsReference() );
		$testCase->assertEquals( self::AUTH_CODE, $fromXmlRequest->getAuthCode() );
		$testCase->assertEquals( self::REFUND_HASH, $fromXmlRequest->getRefundHash() );
		$testCase->assertEquals( self::FRAUD_FILTER, $fromXmlRequest->getFraudFilter() );

		$testCase->assertEquals( self::$RECURRING_FLAG->getRecurringFlag(), $fromXmlRequest->getRecurring()->getFlag() );
		$testCase->assertEquals( self::$RECURRING_TYPE->getType(), $fromXmlRequest->getRecurring()->getType() );
		$testCase->assertEquals( self::$RECURRING_SEQUENCE->getSequence(), $fromXmlRequest->getRecurring()->getSequence() );

		$testCase->assertEquals( self::CUSTOMER_NUMBER, $fromXmlRequest->getTssInfo()->getCustomerNumber() );
		$testCase->assertEquals( self::PRODUCT_ID, $fromXmlRequest->getTssInfo()->getProductId() );
		$testCase->assertEquals( self::VARIABLE_REFERENCE, $fromXmlRequest->getTssInfo()->getVariableReference() );
		$testCase->assertEquals( self::CUSTOMER_IP, $fromXmlRequest->getTssInfo()->getCustomerIpAddress() );
		$addresses = $fromXmlRequest->getTssInfo()->getAddresses();
		$testCase->assertEquals( self::$ADDRESS_TYPE_BUSINESS->getAddressType(), $addresses[0]->getType() );
		$testCase->assertEquals( self::ADDRESS_CODE_BUSINESS, $addresses[0]->getCode() );
		$testCase->assertEquals( self::ADDRESS_COUNTRY_BUSINESS, $addresses[0]->getCountry() );
		$testCase->assertEquals( self::$ADDRESS_TYPE_SHIPPING->getAddressType(), $addresses[1]->getType() );
		$testCase->assertEquals( self::ADDRESS_CODE_SHIPPING, $addresses[1]->getCode() );
		$testCase->assertEquals( self::ADDRESS_COUNTRY_SHIPPING, $addresses[1]->getCountry() );

		$testCase->assertEquals( self::THREE_D_SECURE_CAVV, $fromXmlRequest->getMpi()->getCavv() );
		$testCase->assertEquals( self::THREE_D_SECURE_XID, $fromXmlRequest->getMpi()->getXid() );
		$testCase->assertEquals( self::THREE_D_SECURE_ECI, $fromXmlRequest->getMpi()->getEci() );
	}


	/**
	 * Check all fields match expected values.
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledMobileAuthPaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::AUTH_MOBILE, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::AUTH_MOBILE_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::AUTH_MOBILE_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::$AUTH_MOBILE_AUTO_SETTLE_FLAG->getFlag(), $fromXmlRequest->getAutoSettle()->getFlag() );
		$testCase->assertEquals( self::AUTH_MOBILE_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::AUTH_MOBILE_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::AUTH_MOBILE_MOBILE, $fromXmlRequest->getMobile() );
		$testCase->assertEquals( self::AUTH_MOBILE_TOKEN, $fromXmlRequest->getToken() );
		$testCase->assertEquals( self::AUTH_MOBILE_REQUEST_HASH, $fromXmlRequest->getHash() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledSettlePaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::SETTLE, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::SETTLE_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::SETTLE_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::SETTLE_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::SETTLE_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::SETTLE_REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::SETTLE_AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::SETTLE_CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::SETTLE_PASREF, $fromXmlRequest->getPaymentsReference() );
		$testCase->assertEquals( self::SETTLE_AUTH_CODE, $fromXmlRequest->getAuthCode() );

	}

	/**
	 * Check all fields match expected values->
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledVoidPaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::VOID, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::VOID_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::VOID_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::VOID_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::VOID_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::VOID_REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::VOID_PASREF, $fromXmlRequest->getPaymentsReference() );
		$testCase->assertEquals( self::VOID_AUTH_CODE, $fromXmlRequest->getAuthCode() );
	}

	/**
	 * Check all fields match expected values->
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledRebatePaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::REBATE, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::REBATE_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::REBATE_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::REBATE_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::REBATE_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::REBATE_REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::REBATE_AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::REBATE_CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::REBATE_PASREF, $fromXmlRequest->getPaymentsReference() );
		$testCase->assertEquals( self::REBATE_AUTH_CODE, $fromXmlRequest->getAuthCode() );
		$testCase->assertEquals( self::REBATE_REFUND_HASH, $fromXmlRequest->getRefundHash() );
	}

	/**
	 * Check all fields match expected values->
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledOtbPaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::OTB, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::CARD_NUMBER, $fromXmlRequest->getCard()->getNumber() );
		$testCase->assertEquals( self::$CARD_TYPE->getType(), $fromXmlRequest->getCard()->getType());
 		$testCase->assertEquals( self::CARD_HOLDER_NAME, $fromXmlRequest->getCard()->getCardHolderName() );
 		$testCase->assertEquals( self::CARD_CVN_NUMBER,  $fromXmlRequest->getCard()->getCvn()->getNumber() );
 		$testCase->assertEquals( self::$CARD_CVN_PRESENCE->getIndicator(), $fromXmlRequest->getCard()->getCvn()->getPresenceIndicator());
 		$testCase->assertEquals( self::CARD_ISSUE_NUMBER , $fromXmlRequest->getCard()->getIssueNumber() );
 		$testCase->assertEquals( self::CARD_EXPIRY_DATE, $fromXmlRequest->getCard()->getExpiryDate() );
 		$testCase->assertEquals( self::OTB_ACCOUNT, $fromXmlRequest->getAccount() );
 		$testCase->assertEquals( self::OTB_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
 		$testCase->assertEquals( self::$OTB_AUTO_SETTLE_FLAG->getFlag(), $fromXmlRequest->getAutoSettle()->getFlag());
 		$testCase->assertEquals( self::OTB_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
 		$testCase->assertEquals( self::OTB_ORDER_ID, $fromXmlRequest->getOrderId() );
 		$testCase->assertEquals( self::OTB_REQUEST_HASH, $fromXmlRequest->getHash() );
 	}

	/**
	 * Check all fields match expected values->
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledCreditPaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::CREDIT, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::CREDIT_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::CREDIT_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::CREDIT_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::CREDIT_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::CREDIT_REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::CREDIT_AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::CREDIT_CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::CREDIT_PASREF, $fromXmlRequest->getPaymentsReference() );
		$testCase->assertEquals( self::CREDIT_AUTH_CODE, $fromXmlRequest->getAuthCode() );
		$testCase->assertEquals( self::CREDIT_REFUND_HASH, $fromXmlRequest->getRefundHash() );
	}

	/**
	 * Check all fields match expected values->
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledHoldPaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::HOLD, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::HOLD_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::HOLD_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::HOLD_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::HOLD_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::HOLD_REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::HOLD_PASREF, $fromXmlRequest->getPaymentsReference() );
	}

	/**
	 * Check all fields match expected values->
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledReleasePaymentRequest( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( PaymentType::RELEASE, $fromXmlRequest->getType() );

		$testCase->assertEquals( self::RELEASE_ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::RELEASE_MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( self::RELEASE_TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::RELEASE_ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::RELEASE_REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::RELEASE_PASREF, $fromXmlRequest->getPaymentsReference() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param PaymentRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledPaymentRequestWithSymbols( PaymentRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( self::CARD_NUMBER, $fromXmlRequest->getCard()->getNumber() );

		$testCase->assertEquals( self::$CARD_TYPE->getType(), $fromXmlRequest->getCard()->getType() );
		$testCase->assertEquals( self::CARD_HOLDER_NAME, $fromXmlRequest->getCard()->getCardHolderName() );
		$testCase->assertEquals( self::CARD_CVN_NUMBER, $fromXmlRequest->getCard()->getCvn()->getNumber() );
		$testCase->assertEquals( self::$CARD_CVN_PRESENCE->getIndicator(), $fromXmlRequest->getCard()->getCvn()->getPresenceIndicator() );
		$testCase->assertEquals( self::CARD_ISSUE_NUMBER, $fromXmlRequest->getCard()->getIssueNumber() );
		$testCase->assertEquals( self::CARD_EXPIRY_DATE, $fromXmlRequest->getCard()->getExpiryDate() );

		$testCase->assertEquals( self::ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( PaymentType::AUTH, $fromXmlRequest->getType() );
		$testCase->assertEquals( self:: AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::$AUTO_SETTLE_FLAG->getFlag(), $fromXmlRequest->getAutoSettle()->getFlag() );
		$testCase->assertEquals( self::TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::CHANNEL, $fromXmlRequest->getChannel() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlRequest->getOrderId() );
		$testCase->assertEquals( self::REQUEST_HASH, $fromXmlRequest->getHash() );
		$testCase->assertEquals( self::COMMENT1_WITH_SYMBOLS, $fromXmlRequest->getComments()->get( 0 )->getComment() );
		$testCase->assertEquals( "1", $fromXmlRequest->getComments()->get( 0 )->getId() );
		$testCase->assertEquals( self::COMMENT2_WITH_SYMBOLS, $fromXmlRequest->getComments()->get( 1 )->getComment() );
		$testCase->assertEquals( "2", $fromXmlRequest->getComments()->get( 1 )->getId() );
		$testCase->assertEquals( self::PASREF, $fromXmlRequest->getPaymentsReference() );
		$testCase->assertEquals( self::AUTH_CODE, $fromXmlRequest->getAuthCode() );
		$testCase->assertEquals( self::REFUND_HASH, $fromXmlRequest->getRefundHash() );
		$testCase->assertEquals( self::FRAUD_FILTER, $fromXmlRequest->getFraudFilter() );

		$testCase->assertEquals( self::$RECURRING_FLAG->getRecurringFlag(), $fromXmlRequest->getRecurring()->getFlag() );
		$testCase->assertEquals( self::$RECURRING_TYPE->getType(), $fromXmlRequest->getRecurring()->getType() );
		$testCase->assertEquals( self::$RECURRING_SEQUENCE->getSequence(), $fromXmlRequest->getRecurring()->getSequence() );

		$testCase->assertEquals( self::CUSTOMER_NUMBER_WITH_SYMBOLS, $fromXmlRequest->getTssInfo()->getCustomerNumber() );
		$testCase->assertEquals( self::PRODUCT_ID, $fromXmlRequest->getTssInfo()->getProductId() );
		$testCase->assertEquals( self::VARIABLE_REFERENCE_WITH_SYMBOLS, $fromXmlRequest->getTssInfo()->getVariableReference() );
		$testCase->assertEquals( self::CUSTOMER_IP, $fromXmlRequest->getTssInfo()->getCustomerIpAddress() );
		$addresses = $fromXmlRequest->getTssInfo()->getAddresses();
		$testCase->assertEquals( self::$ADDRESS_TYPE_BUSINESS->getAddressType(), $addresses[0]->getType() );
		$testCase->assertEquals( self::ADDRESS_CODE_BUSINESS, $addresses[0]->getCode() );
		$testCase->assertEquals( self::ADDRESS_COUNTRY_BUSINESS, $addresses[0]->getCountry() );
		$testCase->assertEquals( self::$ADDRESS_TYPE_SHIPPING->getAddressType(), $addresses[1]->getType() );
		$testCase->assertEquals( self::ADDRESS_CODE_SHIPPING, $addresses[1]->getCode() );
		$testCase->assertEquals( self::ADDRESS_COUNTRY_SHIPPING, $addresses[1]->getCountry() );

		$testCase->assertEquals( self::THREE_D_SECURE_CAVV, $fromXmlRequest->getMpi()->getCavv() );
		$testCase->assertEquals( self::THREE_D_SECURE_XID, $fromXmlRequest->getMpi()->getXid() );
		$testCase->assertEquals( self::THREE_D_SECURE_ECI, $fromXmlRequest->getMpi()->getEci() );


	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param RealexServerException $ex
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkBasicResponseError( RealexServerException $ex, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertEquals( self::RESULT_BASIC_ERROR, $ex->getErrorCode() );
		$testCase->assertEquals( self::MESSAGE_BASIC_ERROR, $ex->getMessage() );
		$testCase->assertEquals( self::TIMESTAMP_BASIC_ERROR, $ex->getTimeStamp() );
		$testCase->assertEquals( self::ORDER_ID_BASIC_ERROR, $ex->getOrderId() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param PaymentResponse $response
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkFullResponseError( PaymentResponse $response, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertEquals( self::ACCOUNT, $response->getAccount() );
		$testCase->assertEquals( self::ACQUIRER_RESPONSE, $response->getAcquirerResponse() );
		$testCase->assertEquals( self::AUTH_CODE, $response->getAuthCode() );
		$testCase->assertEquals( self::AUTH_TIME_TAKEN, $response->getAuthTimeTaken() );
		$testCase->assertEquals( self::BATCH_ID, $response->getBatchId() );
		$testCase->assertEquals( self::BANK, $response->getCardIssuer()->getBank() );
		$testCase->assertEquals( self::COUNTRY, $response->getCardIssuer()->getCountry() );
		$testCase->assertEquals( self::COUNTRY_CODE, $response->getCardIssuer()->getCountryCode() );
		$testCase->assertEquals( self::REGION, $response->getCardIssuer()->getRegion() );
		$testCase->assertEquals( self::CVN_RESULT, $response->getCvnResult() );
		$testCase->assertEquals( self::MERCHANT_ID, $response->getMerchantId() );
		$testCase->assertEquals( self::MESSAGE_FULL_ERROR, $response->getMessage() );
		$testCase->assertEquals( self::ORDER_ID, $response->getOrderId() );
		$testCase->assertEquals( self::PASREF, $response->getPaymentsReference() );
		$testCase->assertEquals( self::RESULT_FULL_ERROR, $response->getResult() );
		$testCase->assertEquals( self::RESPONSE_FULL_ERROR_HASH, $response->getHash() );
		$testCase->assertEquals( self::TIMESTAMP_RESPONSE, $response->getTimeStamp() );
		$testCase->assertEquals( self::TIME_TAKEN, $response->getTimeTaken() );
		$testCase->assertEquals( self::TSS_RESULT, $response->getTssResult()->getResult() );
		$checks = $response->getTssResult()->getChecks();
		$testCase->assertEquals( self::TSS_RESULT_CHECK1_ID, $checks[0]->getId() );
		$testCase->assertEquals( self::TSS_RESULT_CHECK1_VALUE, $checks[0]->getValue() );
		$testCase->assertEquals( self::TSS_RESULT_CHECK2_ID, $checks[1]->getId() );
		$testCase->assertEquals( self::TSS_RESULT_CHECK2_VALUE, $checks[1]->getValue() );
		$testCase->assertFalse( $response->isSuccess() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param ThreeDSecureRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 *
	 */
	public static function checkUnmarshalledVerifyEnrolledRequest( ThreeDSecureRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( self::CARD_NUMBER, $fromXmlRequest->getCard()->getNumber() );
		$testCase->assertEquals( self::$CARD_TYPE->getType(), $fromXmlRequest->getCard()->getType() );
		$testCase->assertEquals( self::CARD_HOLDER_NAME, $fromXmlRequest->getCard()->getCardHolderName() );
		$testCase->assertEquals( self::CARD_EXPIRY_DATE, $fromXmlRequest->getCard()->getExpiryDate() );

		$testCase->assertEquals( self::ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( ThreeDSecureType::VERIFY_ENROLLED, $fromXmlRequest->getType() );
		$testCase->assertEquals( self::AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlRequest->getOrderId() );

		$testCase->assertEquals( self::THREE_D_SECURE_VERIFY_ENROLLED_REQUEST_HASH, $fromXmlRequest->getHash() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param ThreeDSecureRequest $fromXmlRequest
	 * @param PHPUnit_Framework_TestCase $testCase
	 *
	 */
	public static function checkUnmarshalledVerifySigRequest( ThreeDSecureRequest $fromXmlRequest, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertNotNull( $fromXmlRequest );
		$testCase->assertEquals( self::CARD_NUMBER, $fromXmlRequest->getCard()->getNumber() );
		$testCase->assertEquals( self::$CARD_TYPE->getType(), $fromXmlRequest->getCard()->getType() );
		$testCase->assertEquals( self::CARD_HOLDER_NAME, $fromXmlRequest->getCard()->getCardHolderName() );
		$testCase->assertEquals( self::CARD_EXPIRY_DATE, $fromXmlRequest->getCard()->getExpiryDate() );

		$testCase->assertEquals( self::ACCOUNT, $fromXmlRequest->getAccount() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlRequest->getMerchantId() );
		$testCase->assertEquals( ThreeDSecureType::VERIFY_SIG, $fromXmlRequest->getType() );
		$testCase->assertEquals( self::AMOUNT, $fromXmlRequest->getAmount()->getAmount() );
		$testCase->assertEquals( self::CURRENCY, $fromXmlRequest->getAmount()->getCurrency() );
		$testCase->assertEquals( self::TIMESTAMP, $fromXmlRequest->getTimeStamp() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlRequest->getOrderId() );

		$testCase->assertEquals( self::THREE_D_SECURE_PARES, $fromXmlRequest->getPares() );
		$testCase->assertEquals( self::THREE_D_SECURE_VERIFY_SIG_REQUEST_HASH, $fromXmlRequest->getHash() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param ThreeDSecureResponse $fromXmlResponse
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledThreeDSecureEnrolledResponse( ThreeDSecureResponse $fromXmlResponse, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertEquals( self::ACCOUNT, $fromXmlResponse->getAccount() );
		$testCase->assertEquals( self::AUTH_CODE, $fromXmlResponse->getAuthCode() );
		$testCase->assertEquals( self::AUTH_TIME_TAKEN, $fromXmlResponse->getAuthTimeTaken() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlResponse->getMerchantId() );
		$testCase->assertEquals( self::THREE_D_SECURE_ENROLLED_MESSAGE, $fromXmlResponse->getMessage() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlResponse->getOrderId() );
		$testCase->assertEquals( self::PASREF, $fromXmlResponse->getPaymentsReference() );
		$testCase->assertEquals( self::THREE_D_SECURE_ENROLLED_RESULT, $fromXmlResponse->getResult() );
		$testCase->assertEquals( self::THREE_D_SECURE_ENROLLED_RESPONSE_HASH, $fromXmlResponse->getHash() );
		$testCase->assertEquals( self::TIMESTAMP_RESPONSE, $fromXmlResponse->getTimeStamp() );
		$testCase->assertEquals( self::TIME_TAKEN, $fromXmlResponse->getTimeTaken() );
		$testCase->assertEquals( self::THREE_D_SECURE_URL, $fromXmlResponse->getUrl() );
		$testCase->assertEquals( self::THREE_D_SECURE_PAREQ, $fromXmlResponse->getPareq() );
		$testCase->assertEquals( self::THREE_D_SECURE_ENROLLED_YES, $fromXmlResponse->getEnrolled() );
		$testCase->assertEquals( self::THREE_D_SECURE_XID, $fromXmlResponse->getXid() );
		$testCase->assertTrue( $fromXmlResponse->isSuccess() );
	}

	/**
	 * Check all fields match expected values.
	 *
	 * @param ThreeDSecureResponse $fromXmlResponse
	 * @param PHPUnit_Framework_TestCase $testCase
	 */
	public static function checkUnmarshalledThreeDSecureSigResponse( ThreeDSecureResponse $fromXmlResponse, PHPUnit_Framework_TestCase $testCase ) {

		$testCase->assertEquals( self::ACCOUNT, $fromXmlResponse->getAccount() );
		$testCase->assertEquals( self::MERCHANT_ID, $fromXmlResponse->getMerchantId() );
		$testCase->assertEquals( self::THREE_D_SECURE_SIG_MESSAGE, $fromXmlResponse->getMessage() );
		$testCase->assertEquals( self::ORDER_ID, $fromXmlResponse->getOrderId() );
		$testCase->assertEquals( self::THREE_D_SECURE_SIG_RESULT, $fromXmlResponse->getResult() );
		$testCase->assertEquals( self::THREE_D_SECURE_SIG_RESPONSE_HASH, $fromXmlResponse->getHash() );
		$testCase->assertEquals( self::TIMESTAMP_RESPONSE, $fromXmlResponse->getTimeStamp() );
		$testCase->assertEquals( self::THREE_D_SECURE_STATUS, $fromXmlResponse->getThreeDSecure()->getStatus() );
		$testCase->assertEquals( self::THREE_D_SECURE_ECI, $fromXmlResponse->getThreeDSecure()->getEci() );
		$testCase->assertEquals( self::THREE_D_SECURE_XID, $fromXmlResponse->getThreeDSecure()->getXid() );
		$testCase->assertEquals( self::THREE_D_SECURE_CAVV, $fromXmlResponse->getThreeDSecure()->getCavv() );
		$testCase->assertEquals( self::THREE_D_SECURE_ALGORITHM, $fromXmlResponse->getThreeDSecure()->getAlgorithm() );
		$testCase->assertTrue( $fromXmlResponse->isSuccess() );
	}


}

SampleXmlValidationUtils::Init();


<?php
/**
 * Private Shop
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    privateshop
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
class ConstUserTypes
{
    const Admin = 1;
    const User = 2;
}
class ConstUserIds
{
    const Admin = 1;
}
class ConstAttachment
{
    const UserAvatar = 1;
    const Product = 2;
	const Category = 0;
}

class ConstMoreAction
{
    const Inactive = 1;
    const Active = 2;
    const Delete = 3;
    const OpenID = 4;
    const Export = 5;
    const Approved = 6;
    const Disapproved = 7;
    const Featured = 8;
    const Notfeatured = 9;
    const Suspend = 10;
    const Twitter = 11;
    const Facebook = 12;
	const Flagged = 13;
	const Unflagged = 14;
	const Unsuspend = 15;
	const Normal = 16;
	const Gmail = 17;
	const Yahoo = 18;
	const Checked = 19;
    const Unchecked = 20;
    const Site = 21;
    const Primary = 22;
	const GenerateAddress = 23;
	const Shipped = 24;
	const Completed = 25;
	const Redeemed = 25;
	const NotRedeemed = 26;
	const NotPaid = 27;
	const Admin = 28;
	const TestMode = 29;
	const Wallet = 30;
	const MassPay = 31;
	const Purchase = 32;
	const Open = 33;
	const Canceled = 34;
	const Upcoming = 35;
}
class ConstBannedTypes
{
    const SingleIPOrHostName = 1;
    const IPRange = 2;
    const RefererBlock = 3;
}
class ConstBannedDurations
{
    const Permanent = 1;
    const Days = 2;
    const Weeks = 3;
}
class ConstMessageFolder
{
    const Inbox = 1;
    const SentMail = 2;
    const Drafts = 3;
    const Spam = 4;
    const Trash = 5;
}

class ConstPaymentGateways
{
    const PayPal = 1;
	const Wallet = 2;
	const ManualPay = 3;
}
class ConstPaymentTypes
{
    const Order = 1;
	const Wallet = 2;
}
class ConstProductTypes
{
    const Shipping = 1;
    const Download = 2;
    const Credit = 3;
}
class ConstProductStatus
{
    const Draft = 1;
    const Upcoming = 2;
    const Open = 3;
    const Closed = 4;
    const Canceled = 5;
    const AwaitingApproval = 6;
    const Rejected = 7;
    const PaidToSeller = 8;
    const OpenForVoting = 9;
}
class ConstOrderStatus
{
    const PaymentPending = 1;
    const InProcess = 2;
    const Expired = 3;
    const CanceledAndRefunded = 4;
    const Shipped = 5;
    const Completed = 6;
	const PaidToSeller = 7;
}
class ConstTransactionTypes
{
    const Purchase = 1;
    const Refund = 2;
	const ReferralAmount = 3;
	const AddedToWallet = 4;
	const UserWithdrawalRequest = 5;
	const AcceptCashWithdrawRequest = 6;
    const AdminApprovedWithdrawalRequest = 7;
    const AdminRejecetedWithdrawalRequest = 8;
    const FailedWithdrawalRequest = 9;
    const AmountRefundedForRejectedWithdrawalRequest = 10;
    const AmountApprovedForUserCashWithdrawalRequest = 11;
    const FailedWithdrawalRequestRefundToUser = 12;
    const PaidToSeller = 16;
	const UserCashWithdrawalAmount = 21;
}
class ConstWithdrawalStatus
{
    const Pending = 1;
    const Approved = 2;
    const Rejected = 3;
    const Failed = 4;
    const Success = 5;
}
class ConsGroupedCountry
{
    const Worldwide = -9;
}
class ConstUserNotification
{
     const ShippedItem = 1;
	 const RefundedItem = 2;
	 const PurchasedItem = 3;
}
class ConstSiteTheme
{
    const Black = 'black';
    const White = 'white';
}
class ConstAttributeGroupType
{
    const Color = 1;
    const Other = 2;
}
class ConstSettingsSubCategory
{
    const Regional = 41;
    const DateAndTime = 43;    
	const Commission = 53;
}
class ConstProductTypeFilter
{
    const Shipping = 3;
    const Downloadable = 4;    
}
class ConstPaymentGatewaysName
{
    const PayPal = 'PayPal';
}
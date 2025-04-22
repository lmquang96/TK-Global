<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $target_month
 * @property string $amount
 * @property int $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereTargetMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdvancePaymentHistory whereUserId($value)
 */
	class AdvancePaymentHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $balance
 * @property string $last_updated
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Balance whereUserId($value)
 */
	class Balance extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $image
 * @property string $image_square
 * @property string $cp_type
 * @property float $commission
 * @property string $commission_type
 * @property string $commission_text
 * @property string $detail
 * @property string|null $description
 * @property int $status 1 - active | 0 - deactive
 * @property string $url
 * @property string|null $tracking_url
 * @property int $link_generate_type 1 - auto | 0 - manual
 * @property string|null $deactived_at
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conversion> $conversions
 * @property-read int|null $conversions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LinkHistory> $linkHistories
 * @property-read int|null $link_histories_count
 * @method static \Database\Factories\CampaignFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign statusActive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCommissionText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCommissionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDeactivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereImageSquare($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereLinkGenerateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereTrackingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereUrl($value)
 */
	class Campaign extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $source
 * @property string $data
 * @property int $status
 * @property int $campaign_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CampaignPostback whereUpdatedAt($value)
 */
	class CampaignPostback extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Campaign> $campaigns
 * @property-read int|null $campaigns_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category statusActive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string|null $agent
 * @property string|null $ip
 * @property int $link_history_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversion|null $conversion
 * @property-read \App\Models\LinkHistory $linkHistory
 * @method static \Database\Factories\ClickFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereLinkHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Click whereUpdatedAt($value)
 */
	class Click extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereValue($value)
 */
	class Config extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $order_code
 * @property string|null $order_time
 * @property string $unit_price
 * @property int $quantity
 * @property string $commission_pub
 * @property string $commission_sys
 * @property string $status
 * @property string $product_code
 * @property string|null $product_name
 * @property string|null $confirmed_at
 * @property int $campaign_id
 * @property int $click_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \App\Models\Click $click
 * @method static \Database\Factories\ConversionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereClickId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereCommissionPub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereCommissionSys($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereOrderCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereOrderTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversion whereUserId($value)
 */
	class Conversion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string|null $original_url
 * @property string|null $domain
 * @property string|null $short_url
 * @property string|null $sub1
 * @property string|null $sub2
 * @property string|null $sub3
 * @property string|null $sub4
 * @property int $user_id
 * @property int $campaign_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Click> $click
 * @property-read int|null $click_count
 * @method static \Database\Factories\LinkHistoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereShortUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereSub1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereSub2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereSub3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereSub4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LinkHistory whereUserId($value)
 */
	class LinkHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $submission_date
 * @property string|null $processing_date
 * @property string $amount
 * @property string|null $comment
 * @property int $status
 * @property string $type
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PaymentRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereProcessingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereSubmissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentRequest whereUserId($value)
 */
	class PaymentRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $phone
 * @property string|null $address
 * @property int|null $city_code
 * @property string|null $city_name
 * @property string $account_type
 * @property string|null $bank_owner
 * @property string|null $bank_number
 * @property string|null $bank_code
 * @property string|null $bank_name
 * @property string|null $bank_branch
 * @property string|null $citizen_id_no
 * @property string|null $citizen_id_date
 * @property string|null $citizen_id_place
 * @property string|null $tax
 * @property string|null $avatar
 * @property string|null $affiliate_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereBankBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereBankCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereBankNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereBankOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCitizenIdDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCitizenIdNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCitizenIdPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUserId($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $admin_rule
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentRequest> $paymentRequests
 * @property-read int|null $payment_requests_count
 * @property-read \App\Models\Profile|null $profile
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAdminRule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}


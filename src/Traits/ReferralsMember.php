<?php

namespace Pdazcom\Referrals\Traits;

use Pdazcom\Referrals\Models\ReferralLink;
use Pdazcom\Referrals\Models\ReferralProgram;
use Pdazcom\Referrals\Models\ReferralRelationship;

/**
 * Trait ReferralsMember
 * @package Pdazcom\Referrals\Traits
 */
trait ReferralsMember {
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public function getReferrals()
    {
        return ReferralProgram::all()->map(function ($program) {
            return ReferralLink::getReferral($this, $program);
        })->filter();
    }

    public function referralProgram()
    {
        return $this->hasOne(ReferralProgram::class, 'id', 'referral_program_id');
    }
	
	public function referrer() {
		return $this->hasOneDeep(self::class, [ReferralRelationship::class, ReferralLink::class], [null, null, 'id', 'id'], [null, null, 'referral_link_id', 'user_id']);
	}
	
	public function referralRelationship() {
		return $this->hasMany(ReferralRelationship::class, 'user_id', 'id');
	}

}
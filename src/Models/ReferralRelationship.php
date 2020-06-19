<?php

namespace Pdazcom\Referrals\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralRelationship extends Model
{
    protected $fillable = ['referral_link_id', 'user_id'];
	
	public function referee() {
		return $this->belongsTo(config('auth.providers.users.model'), 'user_id');
	}
}
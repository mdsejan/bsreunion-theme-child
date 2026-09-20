<?php
/**
 * Portable reunion registration form block.
 * Used by [reunion_form] shortcode and page-register.php.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brc               = function_exists( 'brc_get_theme_settings' ) ? brc_get_theme_settings() : array();
$brc_pass_price    = ! empty( $brc['pass_price'] ) ? $brc['pass_price'] : '৳১,০০০';
$brc_pass_numeric  = (int) preg_replace( '/[^0-9]/', '', $brc_pass_price );
if ( 0 === $brc_pass_numeric ) {
	$brc_pass_numeric = 1000;
}
$brc_pass_display  = ltrim( trim( $brc_pass_price ), "৳ \t\n\r\0\x0B" );
if ( '' === $brc_pass_display ) {
	$brc_pass_display = '১,০০০';
}
$brc_email         = ! empty( $brc['email'] ) ? $brc['email'] : 'help@bagbari-reunion.com';
?>
<!-- SHORTCODE-START: [reunion_form] -->
<main id="reunion-form" class="relative bg-maroon overflow-hidden">
	<div class="grain"></div>
	<div class="relative max-w-3xl mx-auto px-5 sm:px-8 pb-20 sm:pb-28">
		<div class="relative overflow-hidden p-6 sm:p-10 rounded-2xl border border-gold/30" style="background:#610B17;box-shadow:0 30px 60px -20px rgba(0,0,0,.55)">
			<div class="relative">
				<form action="#" method="POST" id="reunionForm" enctype="multipart/form-data">

					<div class="hidden" aria-hidden="true">
						<label for="honeypot">Do not fill this field</label>
						<input type="text" id="honeypot" name="honeypot" value="" tabindex="-1" autocomplete="off">
					</div>

					<h2 class="rf-section font-display text-xl"><?php esc_html_e( '১. ব্যক্তিগত বিবরণ', 'bagbari-reunion-sejan' ); ?></h2>

					<div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
						<div>
							<label class="rf-label" for="full_name"><?php esc_html_e( 'নাম', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<input type="text" id="full_name" required name="full_name" placeholder="<?php echo esc_attr__( 'আপনার নাম লিখুন', 'bagbari-reunion-sejan' ); ?>" autocomplete="name" class="rf-input">
						</div>
						<div>
							<label class="rf-label" for="phone"><?php esc_html_e( 'মোবাইল নম্বর', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<input type="tel" id="phone" required name="phone" placeholder="01XXXXXXXXX" autocomplete="tel" inputmode="numeric" pattern="01[3-9][0-9]{8}" title="<?php echo esc_attr__( 'সঠিক ১১ সংখ্যার মোবাইল নম্বর দিন (01 দিয়ে শুরু)', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
					</div>

					<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
						<div>
							<label class="rf-label" for="father"><?php esc_html_e( 'পিতার নাম', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<input type="text" id="father" required name="father_husband_name" placeholder="<?php echo esc_attr__( 'পিতা বা স্বামীর নাম লিখুন', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
						<div>
							<label class="rf-label" for="mother"><?php esc_html_e( 'মাতার নাম', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<input type="text" id="mother" required name="mother_name" placeholder="<?php echo esc_attr__( 'মাতার নাম লিখুন', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
					</div>

					<div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
						<div>
							<label class="rf-label" for="ssc_batch"><?php esc_html_e( 'এসএসসি ব্যাচ', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<select required name="ssc_batch" id="ssc_batch" class="rf-input">
								<option value="" disabled selected><?php esc_html_e( 'সিলেক্ট করুন', 'bagbari-reunion-sejan' ); ?></option>
							</select>
						</div>
						<div>
							<label class="rf-label" for="last_class"><?php esc_html_e( 'কোন শ্রেণী পর্যন্ত পড়েছেন?', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<select required name="last_class" id="last_class" class="rf-input">
								<option value="" disabled selected><?php esc_html_e( 'সিলেক্ট করুন', 'bagbari-reunion-sejan' ); ?></option>
								<option value="Class 6"><?php esc_html_e( 'ষষ্ঠ শ্রেণী', 'bagbari-reunion-sejan' ); ?></option>
								<option value="Class 7"><?php esc_html_e( 'সপ্তম শ্রেণী', 'bagbari-reunion-sejan' ); ?></option>
								<option value="Class 8"><?php esc_html_e( 'অষ্টম শ্রেণী', 'bagbari-reunion-sejan' ); ?></option>
								<option value="Class 9"><?php esc_html_e( 'নবম শ্রেণী', 'bagbari-reunion-sejan' ); ?></option>
								<option value="Class 10"><?php esc_html_e( 'দশম শ্রেণী', 'bagbari-reunion-sejan' ); ?></option>
								<option value="SSC"><?php esc_html_e( 'এসএসসি', 'bagbari-reunion-sejan' ); ?></option>
							</select>
						</div>
						<div>
							<label class="rf-label" for="blood"><?php esc_html_e( 'ব্লাড গ্রুপ (ঐচ্ছিক)', 'bagbari-reunion-sejan' ); ?></label>
							<select name="blood_group" id="blood" class="rf-input">
								<option value="" disabled selected><?php esc_html_e( 'সিলেক্ট করুন', 'bagbari-reunion-sejan' ); ?></option>
								<option value="A+">A+</option>
								<option value="A-">A−</option>
								<option value="B+">B+</option>
								<option value="B-">B−</option>
								<option value="O+">O+</option>
								<option value="O-">O−</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB−</option>
							</select>
						</div>
					</div>

					<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
						<div>
							<label class="rf-label" for="perm_addr"><?php esc_html_e( 'স্থায়ী ঠিকানা', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<input type="text" id="perm_addr" required name="permanent_address" placeholder="<?php echo esc_attr__( 'গ্রাম, ইউনিয়ন, থানা, জেলা', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
						<div>
							<label class="rf-label" for="pres_addr"><?php esc_html_e( 'বর্তমান ঠিকানা', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
							<input type="text" id="pres_addr" required name="present_address" placeholder="<?php echo esc_attr__( 'বর্তমানে যেখানে থাকেন', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
					</div>

					<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
						<fieldset>
							<legend class="rf-label"><?php esc_html_e( 'লিঙ্গ', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></legend>
							<div class="flex gap-3">
								<label class="flex-1"><input type="radio" required name="gender" value="পুরুষ" class="sr-only"><span class="rf-check"><?php esc_html_e( 'পুরুষ', 'bagbari-reunion-sejan' ); ?></span></label>
								<label class="flex-1"><input type="radio" name="gender" value="মহিলা" class="sr-only"><span class="rf-check"><?php esc_html_e( 'মহিলা', 'bagbari-reunion-sejan' ); ?></span></label>
							</div>
						</fieldset>
						<fieldset>
							<legend class="rf-label"><?php esc_html_e( 'বৈবাহিক অবস্থা', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></legend>
							<div class="flex gap-3">
								<label class="flex-1"><input type="radio" required name="marital_status" value="বিবাহিত" class="sr-only"><span class="rf-check"><?php esc_html_e( 'বিবাহিত', 'bagbari-reunion-sejan' ); ?></span></label>
								<label class="flex-1"><input type="radio" name="marital_status" value="অবিবাহিত" class="sr-only"><span class="rf-check"><?php esc_html_e( 'অবিবাহিত', 'bagbari-reunion-sejan' ); ?></span></label>
							</div>
						</fieldset>
					</div>

					<h2 class="rf-section font-display text-xl mt-10"><?php esc_html_e( '২. পেশাগত বিবরণ', 'bagbari-reunion-sejan' ); ?></h2>

					<fieldset class="mt-5">
						<legend class="rf-label"><?php esc_html_e( 'পেশা', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></legend>
						<div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
							<label><input type="radio" required name="profession" value="চাকুরীজীবী" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'চাকুরীজীবী', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="ব্যবসায়ী" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'ব্যবসায়ী', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="গৃহিণী" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'গৃহিণী', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="কৃষক" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'কৃষক', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="অবসরপ্রাপ্ত" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'অবসরপ্রাপ্ত', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="ছাত্র" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'ছাত্র', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="প্রবাসী" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'প্রবাসী', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="profession" value="অন্যান্য" class="sr-only"><span class="rf-check text-sm"><?php esc_html_e( 'অন্যান্য', 'bagbari-reunion-sejan' ); ?></span></label>
						</div>
					</fieldset>

					<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
						<div>
							<label class="rf-label" for="company"><?php esc_html_e( 'প্রতিষ্ঠানের নাম', 'bagbari-reunion-sejan' ); ?></label>
							<input type="text" id="company" name="company_name" placeholder="<?php echo esc_attr__( 'যেখানে কর্মরত (যদি থাকে)', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
						<div>
							<label class="rf-label" for="desig"><?php esc_html_e( 'পদবী', 'bagbari-reunion-sejan' ); ?></label>
							<input type="text" id="desig" name="designation" placeholder="<?php echo esc_attr__( 'আপনার পদবী (যদি থাকে)', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
						</div>
					</div>

					<h2 class="rf-section font-display text-xl mt-10"><?php esc_html_e( '৩. উৎসবের তথ্য ও ফি', 'bagbari-reunion-sejan' ); ?></h2>

					<div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
						<fieldset>
							<legend class="rf-label"><?php esc_html_e( 'পার্কিং সুবিধা প্রয়োজন?', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></legend>
							<div class="flex gap-3">
								<label class="flex-1"><input type="radio" required name="has_parking" value="হ্যাঁ" class="sr-only"><span class="rf-check"><?php esc_html_e( 'হ্যাঁ', 'bagbari-reunion-sejan' ); ?></span></label>
								<label class="flex-1"><input type="radio" name="has_parking" value="না" class="sr-only"><span class="rf-check"><?php esc_html_e( 'না', 'bagbari-reunion-sejan' ); ?></span></label>
							</div>
						</fieldset>
						<fieldset>
							<legend class="rf-label"><?php esc_html_e( 'উপহারের পোশাক', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></legend>
							<div class="flex flex-wrap gap-2">
								<label><input type="radio" required name="apparel" value="S" class="sr-only"><span class="rf-check rf-check-pill">S</span></label>
								<label><input type="radio" name="apparel" value="M" class="sr-only"><span class="rf-check rf-check-pill">M</span></label>
								<label><input type="radio" name="apparel" value="L" class="sr-only"><span class="rf-check rf-check-pill">L</span></label>
								<label><input type="radio" name="apparel" value="XL" class="sr-only"><span class="rf-check rf-check-pill">XL</span></label>
								<label><input type="radio" name="apparel" value="XXL" class="sr-only"><span class="rf-check rf-check-pill">XXL</span></label>
								<label><input type="radio" name="apparel" value="Shari" class="sr-only"><span class="rf-check rf-check-pill"><?php esc_html_e( 'শাড়ি', 'bagbari-reunion-sejan' ); ?></span></label>
							</div>
						</fieldset>
					</div>

					<div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
						<div>
							<label class="rf-label" for="guests"><?php esc_html_e( 'অতিথির সংখ্যা', 'bagbari-reunion-sejan' ); ?></label>
							<input type="number" id="guests" name="guests" min="0" value="0" inputmode="numeric" class="rf-input">
							<span class="rf-hint"><?php esc_html_e( 'শুধুমাত্র পরিবারের সদস্য (বাবা, মা, স্ত্রী, সন্তান) — প্রতিজন ৳৫০০', 'bagbari-reunion-sejan' ); ?></span>
						</div>
						<div>
							<label class="rf-label" for="donation"><?php esc_html_e( 'অনুদান (ঐচ্ছিক)', 'bagbari-reunion-sejan' ); ?></label>
							<input type="number" id="donation" name="donation" min="0" value="0" placeholder="<?php echo esc_attr__( 'যেমন: ৫০০', 'bagbari-reunion-sejan' ); ?>" inputmode="numeric" class="rf-input">
							<span class="rf-hint"><?php esc_html_e( 'ভালোবেসে অতিরিক্ত দিতে চাইলে', 'bagbari-reunion-sejan' ); ?></span>
						</div>
						<div>
							<label class="rf-label" for="reg_fee"><?php esc_html_e( 'রেজিস্ট্রেশন ফি (সদস্য)', 'bagbari-reunion-sejan' ); ?></label>
							<input type="text" readonly id="reg_fee" value="<?php echo esc_attr( $brc_pass_display ); ?>" tabindex="-1" class="rf-input" style="background:#EDE6DA;cursor:not-allowed" data-base-fee="<?php echo esc_attr( $brc_pass_numeric ); ?>">
						</div>
					</div>

					<div class="mt-4 rounded-2xl border border-gold/35 bg-gold/10 p-4 flex justify-between items-center gap-4">
						<span class="text-paper/85"><?php esc_html_e( 'সর্বমোট প্রদেয়', 'bagbari-reunion-sejan' ); ?></span>
						<span class="font-display text-2xl text-[#F4C430]">৳<span id="total_fee" data-base-fee="<?php echo esc_attr( $brc_pass_numeric ); ?>"><?php echo esc_html( $brc_pass_display ); ?></span></span>
					</div>

					<h2 class="rf-section font-display text-xl mt-10"><?php esc_html_e( '৪. পেমেন্ট পদ্ধতি', 'bagbari-reunion-sejan' ); ?></h2>

					<fieldset class="mt-5">
						<legend class="rf-label"><?php esc_html_e( 'পেমেন্ট মাধ্যম', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></legend>
						<div class="grid grid-cols-2 gap-3">
							<label><input type="radio" required name="payment_method_group" value="mobile" id="pay_mobile" checked class="sr-only"><span class="rf-check">📱 <?php esc_html_e( 'মোবাইল ব্যাংকিং', 'bagbari-reunion-sejan' ); ?></span></label>
							<label><input type="radio" name="payment_method_group" value="bank" id="pay_bank" class="sr-only"><span class="rf-check">🏦 <?php esc_html_e( 'ব্যাংক অ্যাকাউন্ট', 'bagbari-reunion-sejan' ); ?></span></label>
						</div>
					</fieldset>

					<div id="mobile_banking_panel" class="mt-4 space-y-4">
						<div class="rounded-2xl border border-gold/25 bg-ink/30 p-5 text-sm text-paper/85 space-y-3">
							<p class="font-display text-[#F4C430]">💸 <?php esc_html_e( 'মোবাইল ব্যাংকিং নিয়মাবলী', 'bagbari-reunion-sejan' ); ?></p>
							<p><?php esc_html_e( '১. হিসাবকৃত সর্বমোট টাকা নিচের যেকোনো একটি প্রতিনিধি নম্বরে Send Money করুন। প্রতিটি নম্বরে বিকাশ, নগদ ও রকেট — তিনটিই চালু আছে:', 'bagbari-reunion-sejan' ); ?></p>
							<div class="grid grid-cols-1 gap-4 pt-2">
								<?php
								$reps = array(
									array( '1', '01783694781', '01783 694 781' ),
									array( '2', '01793694542', '01793 694 542' ),
									array( '3', '01739582693', '01739 582 693' ),
								);
								foreach ( $reps as $rep ) :
									?>
									<div class="rf-rep-card" data-rep="<?php echo esc_attr( $rep[0] ); ?>">
										<div class="flex items-center justify-between gap-3">
											<p class="font-display text-[#610B17]"><?php printf( esc_html__( 'প্রতিনিধি নম্বর %s', 'bagbari-reunion-sejan' ), esc_html( $rep[0] ) ); ?> <span class="text-xs font-sans font-normal text-[#756E68]"><?php esc_html_e( '(পার্সোনাল)', 'bagbari-reunion-sejan' ); ?></span></p>
											<div class="flex flex-wrap gap-1.5 justify-end">
												<span class="rf-mfs" style="background:#e2136e"><?php esc_html_e( 'বিকাশ', 'bagbari-reunion-sejan' ); ?></span>
												<span class="rf-mfs" style="background:#f6921e"><?php esc_html_e( 'নগদ', 'bagbari-reunion-sejan' ); ?></span>
												<span class="rf-mfs" style="background:#8c3494"><?php esc_html_e( 'রকেট', 'bagbari-reunion-sejan' ); ?></span>
											</div>
										</div>
										<p class="rf-rep-num" data-copy="<?php echo esc_attr( $rep[1] ); ?>" role="button" tabindex="0" title="<?php echo esc_attr__( 'কপি করতে ক্লিক করুন', 'bagbari-reunion-sejan' ); ?>"><?php echo esc_html( $rep[2] ); ?></p>
										<button type="button" class="rf-copy-btn w-full" data-copy="<?php echo esc_attr( $rep[1] ); ?>">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" /><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" /></svg>
											<span><?php esc_html_e( 'কপি করুন', 'bagbari-reunion-sejan' ); ?></span>
										</button>
									</div>
								<?php endforeach; ?>
							</div>
							<p><?php esc_html_e( '২. টাকা পাঠানোর পর ট্রানজেকশন আইডি (TxID) সংগ্রহ করে নিচের ঘরগুলো পূরণ করুন।', 'bagbari-reunion-sejan' ); ?></p>
						</div>

						<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
							<div>
								<label class="rf-label" for="mobile_provider"><?php esc_html_e( 'কোন মাধ্যমে দিয়েছেন?', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
								<select name="mobile_provider" id="mobile_provider" required class="rf-input">
									<option value="" disabled selected><?php esc_html_e( 'সিলেক্ট করুন', 'bagbari-reunion-sejan' ); ?></option>
									<option value="bKash-781">বিকাশ (781)</option>
									<option value="bKash-542">বিকাশ (542)</option>
									<option value="bKash-693">বিকাশ (693)</option>
									<option value="Nagad-781">নগদ (781)</option>
									<option value="Nagad-542">নগদ (542)</option>
									<option value="Nagad-693">নগদ (693)</option>
									<option value="Rocket-781">রকেট (781)</option>
									<option value="Rocket-542">রকেট (542)</option>
									<option value="Rocket-693">রকেট (693)</option>
								</select>
							</div>
							<div>
								<label class="rf-label" for="sender_number"><?php esc_html_e( 'প্রেরক নম্বর', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
								<input type="tel" name="sender_number" id="sender_number" required placeholder="01XXXXXXXXX" inputmode="numeric" pattern="01[3-9][0-9]{8}" title="<?php echo esc_attr__( 'সঠিক ১১ সংখ্যার মোবাইল নম্বর দিন', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
							</div>
							<div>
								<label class="rf-label" for="transaction_id"><?php esc_html_e( 'ট্রানজেকশন আইডি (TxID)', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
								<input type="text" name="transaction_id" id="transaction_id" required placeholder="যেমন: BKA3X7R9Z2" class="rf-input uppercase">
							</div>
						</div>
					</div>

					<div id="bank_banking_panel" class="mt-4 space-y-4 hidden">
						<div class="rounded-2xl border border-gold/25 bg-ink/30 p-5 text-sm text-paper/85 space-y-2">
							<p class="font-display text-[#F4C430]">🏦 <?php esc_html_e( 'ব্যাংক অ্যাকাউন্ট বিবরণী', 'bagbari-reunion-sejan' ); ?></p>
							<p><?php esc_html_e( 'ব্যাংকের নাম:', 'bagbari-reunion-sejan' ); ?> <span class="font-semibold"><?php esc_html_e( 'ডাচ-বাংলা ব্যাংক পিএলসি', 'bagbari-reunion-sejan' ); ?></span></p>
							<p><?php esc_html_e( 'অ্যাকাউন্ট নাম:', 'bagbari-reunion-sejan' ); ?> <span class="font-semibold">BKMHS Reunion &amp; Alumni Association</span></p>
							<p><?php esc_html_e( 'অ্যাকাউন্ট নম্বর:', 'bagbari-reunion-sejan' ); ?> <span class="font-semibold text-[#F4C430]">125 43287 98341</span></p>
							<p><?php esc_html_e( 'ব্রাঞ্চ: বগুড়া শাখা, বগুড়া।', 'bagbari-reunion-sejan' ); ?></p>
						</div>
						<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
							<div>
								<label class="rf-label" for="bank_account_info"><?php esc_html_e( 'আপনার ব্যাংক হিসাব নম্বর / নাম', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
								<input type="text" name="bank_account_info" id="bank_account_info" placeholder="<?php echo esc_attr__( 'যেমন: আপনার ব্যাংক হিসাব নম্বর বা নাম', 'bagbari-reunion-sejan' ); ?>" class="rf-input">
							</div>
							<div>
								<label class="rf-label" for="bank_receipt"><?php esc_html_e( 'পেমেন্ট রসিদ / স্ক্রিনশট', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
								<input type="file" name="bank_receipt" id="bank_receipt" accept="image/*,.pdf" class="rf-input">
							</div>
						</div>
					</div>

					<h2 class="rf-section font-display text-xl mt-10"><?php esc_html_e( '৫. আবেদনকারীর ছবি', 'bagbari-reunion-sejan' ); ?></h2>

					<div class="mt-5">
						<label class="rf-label" for="applicant_photo"><?php esc_html_e( 'আপনার ছবি আপলোড করুন', 'bagbari-reunion-sejan' ); ?> <span class="rf-req">*</span></label>
						<input type="file" name="applicant_photo" id="applicant_photo" required accept="image/jpeg,image/png,image/webp" class="rf-input">
						<span class="rf-hint"><?php esc_html_e( 'JPG, PNG বা WebP — সর্বোচ্চ ২ MB', 'bagbari-reunion-sejan' ); ?></span>
						<p id="photo_error" class="hidden text-sm mt-2" style="color:#ff9d9d" role="alert"></p>
						<div class="mt-4 hidden items-center gap-4" id="photo_preview_wrap">
							<img id="photo_preview" alt="<?php echo esc_attr__( 'আপলোড করা ছবির প্রিভিউ', 'bagbari-reunion-sejan' ); ?>" class="w-20 h-20 rounded-xl object-cover border border-gold/40">
							<button type="button" id="photo_remove" class="text-sm text-paper/70 underline underline-offset-4 hover:text-[#F4C430]"><?php esc_html_e( 'ছবি বাদ দিন', 'bagbari-reunion-sejan' ); ?></button>
						</div>
					</div>

					<div class="pt-8">
						<button type="submit" id="submitBtn" class="btn-gold w-full rounded-full font-bold text-lg px-6 py-4" style="color:#610B17">
							<?php esc_html_e( 'নিবন্ধন সম্পন্ন করুন', 'bagbari-reunion-sejan' ); ?>
						</button>
						<p class="text-[11px] text-center text-paper/55 mt-3">
							<?php esc_html_e( '“নিবন্ধন সম্পন্ন করুন” বাটনে ক্লিক করার মাধ্যমে আপনি ইভেন্টের শর্তাবলী মেনে নিচ্ছেন।', 'bagbari-reunion-sejan' ); ?><br>
							✉️ <?php esc_html_e( 'সহায়তা:', 'bagbari-reunion-sejan' ); ?> <a href="<?php echo esc_url( 'mailto:' . $brc_email ); ?>" class="text-[#F4C430] font-medium"><?php echo esc_html( $brc_email ); ?></a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
<!-- SHORTCODE-END: [reunion_form] -->

(() => {
	'use strict';

	const BN_DIGITS = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
	const toBn = (n) =>
		String(n)
			.split('')
			.map((d) => (BN_DIGITS[d] !== undefined ? BN_DIGITS[d] : d))
			.join('');
	const bnNum = (n) => Number(n).toLocaleString('bn-BD');

	const batchSelect = document.getElementById('ssc_batch');
	if (batchSelect && batchSelect.options.length <= 1) {
		for (let year = 2025; year >= 1980; year--) {
			const option = document.createElement('option');
			option.value = year;
			option.textContent = 'ব্যাচ ' + toBn(year);
			batchSelect.appendChild(option);
		}
	}

	const guestsInput = document.getElementById('guests');
	const donationInput = document.getElementById('donation');
	const totalFeeEl = document.getElementById('total_fee');

	function calculateTotal() {
		if (!guestsInput || !donationInput || !totalFeeEl) {
			return;
		}
		let guestCount = Math.floor(Number(guestsInput.value)) || 0;
		let donationAmt = Math.floor(Number(donationInput.value)) || 0;
		if (guestCount < 0) {
			guestsInput.value = 0;
			guestCount = 0;
		}
		if (donationAmt < 0) {
			donationInput.value = 0;
			donationAmt = 0;
		}
		totalFeeEl.textContent = bnNum(1000 + guestCount * 500 + donationAmt);
	}
	if (guestsInput && donationInput) {
		guestsInput.addEventListener('input', calculateTotal);
		donationInput.addEventListener('input', calculateTotal);
		calculateTotal();
	}

	const payMobile = document.getElementById('pay_mobile');
	const payBank = document.getElementById('pay_bank');
	const mobilePanel = document.getElementById('mobile_banking_panel');
	const bankPanel = document.getElementById('bank_banking_panel');
	const mobileProvider = document.getElementById('mobile_provider');
	const senderNumber = document.getElementById('sender_number');
	const transactionId = document.getElementById('transaction_id');
	const bankAccountInfo = document.getElementById('bank_account_info');
	const bankReceipt = document.getElementById('bank_receipt');

	function showMobilePanel() {
		if (!mobilePanel || !bankPanel) {
			return;
		}
		mobilePanel.classList.remove('hidden');
		bankPanel.classList.add('hidden');
		if (mobileProvider) {
			mobileProvider.required = true;
		}
		if (senderNumber) {
			senderNumber.required = true;
		}
		if (transactionId) {
			transactionId.required = true;
		}
		if (bankAccountInfo) {
			bankAccountInfo.required = false;
		}
		if (bankReceipt) {
			bankReceipt.required = false;
		}
	}

	function showBankPanel() {
		if (!mobilePanel || !bankPanel) {
			return;
		}
		bankPanel.classList.remove('hidden');
		mobilePanel.classList.add('hidden');
		if (bankAccountInfo) {
			bankAccountInfo.required = true;
		}
		if (bankReceipt) {
			bankReceipt.required = true;
		}
		if (mobileProvider) {
			mobileProvider.required = false;
		}
		if (senderNumber) {
			senderNumber.required = false;
		}
		if (transactionId) {
			transactionId.required = false;
		}
	}

	if (payMobile) {
		payMobile.addEventListener('change', () => {
			if (payMobile.checked) {
				showMobilePanel();
			}
		});
	}
	if (payBank) {
		payBank.addEventListener('change', () => {
			if (payBank.checked) {
				showBankPanel();
			}
		});
	}
	if (payMobile && payBank) {
		showMobilePanel();
	}

	function flashCopied(btn) {
		const label = btn.querySelector('span');
		const original = label ? label.textContent : '';
		btn.classList.add('rf-copied');
		if (label) {
			label.textContent = 'কপি হয়েছে! ✔️';
		}
		setTimeout(() => {
			btn.classList.remove('rf-copied');
			if (label) {
				label.textContent = original;
			}
		}, 2000);
	}

	async function copyNumber(number, btn) {
		try {
			await navigator.clipboard.writeText(number);
		} catch (err) {
			const ta = document.createElement('textarea');
			ta.value = number;
			ta.style.position = 'fixed';
			ta.style.opacity = '0';
			document.body.appendChild(ta);
			ta.select();
			try {
				document.execCommand('copy');
			} catch (e) {
				/* noop */
			}
			document.body.removeChild(ta);
		}
		if (btn) {
			flashCopied(btn);
		}
	}

	document.querySelectorAll('#reunion-form .rf-copy-btn').forEach((btn) => {
		btn.addEventListener('click', () => copyNumber(btn.dataset.copy, btn));
	});
	document.querySelectorAll('#reunion-form .rf-rep-num').forEach((box) => {
		const card = box.closest('.rf-rep-card');
		const btn = card ? card.querySelector('.rf-copy-btn') : null;
		const go = () => copyNumber(box.dataset.copy, btn);
		box.addEventListener('click', go);
		box.addEventListener('keydown', (e) => {
			if (e.key === 'Enter' || e.key === ' ') {
				e.preventDefault();
				go();
			}
		});
	});

	const PHOTO_MAX_BYTES = 2 * 1024 * 1024;
	const PHOTO_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
	const photoInput = document.getElementById('applicant_photo');
	const photoError = document.getElementById('photo_error');
	const photoWrap = document.getElementById('photo_preview_wrap');
	const photoPreview = document.getElementById('photo_preview');
	const photoRemove = document.getElementById('photo_remove');
	let photoObjectUrl = '';

	function setPhotoError(msg) {
		if (!photoError) {
			return;
		}
		if (!msg) {
			photoError.textContent = '';
			photoError.classList.add('hidden');
			return;
		}
		photoError.textContent = msg;
		photoError.classList.remove('hidden');
	}

	function clearPhotoPreview() {
		if (photoObjectUrl) {
			URL.revokeObjectURL(photoObjectUrl);
			photoObjectUrl = '';
		}
		if (photoPreview) {
			photoPreview.removeAttribute('src');
		}
		if (photoWrap) {
			photoWrap.classList.add('hidden');
			photoWrap.classList.remove('flex');
		}
	}

	function validatePhoto(file) {
		if (!file) {
			return 'আপনার ছবি আপলোড করুন।';
		}
		if (!PHOTO_TYPES.includes(file.type)) {
			return 'শুধু JPG, PNG বা WebP ছবি দিন।';
		}
		if (file.size > PHOTO_MAX_BYTES) {
			return 'ছবির সাইজ ২ MB-এর মধ্যে রাখুন।';
		}
		return '';
	}

	if (photoInput) {
		photoInput.addEventListener('change', () => {
			const file = photoInput.files && photoInput.files[0];
			setPhotoError('');
			clearPhotoPreview();
			if (!file) {
				return;
			}
			const err = validatePhoto(file);
			if (err) {
				photoInput.value = '';
				setPhotoError(err);
				photoInput.focus();
				return;
			}
			photoObjectUrl = URL.createObjectURL(file);
			if (photoPreview) {
				photoPreview.src = photoObjectUrl;
			}
			if (photoWrap) {
				photoWrap.classList.remove('hidden');
				photoWrap.classList.add('flex');
			}
		});
	}

	if (photoRemove && photoInput) {
		photoRemove.addEventListener('click', () => {
			photoInput.value = '';
			setPhotoError('');
			clearPhotoPreview();
			photoInput.focus();
		});
	}

	const reunionForm = document.getElementById('reunionForm');
	if (reunionForm) {
		reunionForm.addEventListener('submit', (e) => {
			const honeypot = document.getElementById('honeypot');
			if (honeypot && honeypot.value) {
				e.preventDefault();
				return;
			}
			if (payBank && payBank.checked && bankReceipt) {
				const receipt = bankReceipt.files && bankReceipt.files[0];
				if (!receipt) {
					e.preventDefault();
					bankReceipt.focus();
					return;
				}
				const okTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
				if (!okTypes.includes(receipt.type) || receipt.size > 5 * 1024 * 1024) {
					e.preventDefault();
					bankReceipt.focus();
					return;
				}
			}
			if (photoInput) {
				const file = photoInput.files && photoInput.files[0];
				const err = validatePhoto(file);
				if (err) {
					e.preventDefault();
					setPhotoError(err);
					photoInput.focus();
				}
			}
		});
	}
})();

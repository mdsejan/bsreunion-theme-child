(() => {
	'use strict';

	const REDUCE = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	const header = document.getElementById('siteHeader');
	const progressBar = document.getElementById('progressBar');
	let raf = 0;

	const onScroll = () => {
		if (raf) {
			return;
		}
		raf = requestAnimationFrame(() => {
			const el = document.documentElement;
			if (header) {
				if (window.scrollY > 40) {
					header.classList.add('bg-ink/90', 'nav-blur', 'shadow-lg', 'border-b', 'border-gold/15');
				} else {
					header.classList.remove('bg-ink/90', 'nav-blur', 'shadow-lg', 'border-b', 'border-gold/15');
				}
			}
			if (progressBar) {
				const max = el.scrollHeight - el.clientHeight;
				progressBar.style.transform = 'scaleX(' + (max > 0 ? el.scrollTop / max : 0) + ')';
			}
			raf = 0;
		});
	};
	document.addEventListener('scroll', onScroll, { passive: true });
	onScroll();

	const menuBtn = document.getElementById('menuBtn');
	const mobileMenu = document.getElementById('mobileMenu');
	if (menuBtn && mobileMenu) {
		menuBtn.addEventListener('click', () => {
			const open = mobileMenu.classList.toggle('hidden');
			menuBtn.setAttribute('aria-expanded', String(!open));
		});
		mobileMenu.querySelectorAll('a').forEach((a) =>
			a.addEventListener('click', () => {
				mobileMenu.classList.add('hidden');
				menuBtn.setAttribute('aria-expanded', 'false');
			})
		);
	}

	const BN_DIGITS = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
	const toBn = (n) =>
		String(n)
			.padStart(2, '0')
			.split('')
			.map((d) => BN_DIGITS[d] || d)
			.join('');

	const targetRaw = window.BRC_THEME && window.BRC_THEME.countdownTarget ? window.BRC_THEME.countdownTarget : '2026-11-25T09:00:00+06:00';
	const target = new Date(targetRaw).getTime();
	const cd = {
		days: document.querySelector('[data-cd="days"]'),
		hours: document.querySelector('[data-cd="hours"]'),
		mins: document.querySelector('[data-cd="mins"]'),
		secs: document.querySelector('[data-cd="secs"]')
	};

	if (cd.days && cd.hours && cd.mins && cd.secs) {
		const tick = () => {
			const diff = Math.max(0, target - Date.now());
			cd.days.textContent = toBn(Math.floor(diff / 86400000));
			cd.hours.textContent = toBn(Math.floor((diff % 86400000) / 3600000));
			cd.mins.textContent = toBn(Math.floor((diff % 3600000) / 60000));
			cd.secs.textContent = toBn(Math.floor((diff % 60000) / 1000));
		};
		tick();
		setInterval(tick, 1000);
	}

	(() => {
		const els = document.querySelectorAll('.f2026-reveal');
		if (!els.length) {
			return;
		}
		if (REDUCE || !('IntersectionObserver' in window)) {
			els.forEach((el) => el.classList.add('is-in'));
			return;
		}
		const io = new IntersectionObserver(
			(entries) => {
				entries.forEach((e) => {
					if (e.isIntersecting) {
						e.target.classList.add('is-in');
						io.unobserve(e.target);
					}
				});
			},
			{ threshold: 0.2 }
		);
		els.forEach((el) => io.observe(el));
	})();

	if (!REDUCE && window.gsap && window.ScrollTrigger) {
		gsap.registerPlugin(ScrollTrigger);

		const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });
		heroTl
			.to('#heroImg', { scale: 1, duration: 1.8, ease: 'power2.out' }, 0)
			.to('.hero-line-in', { y: 0, duration: 1, stagger: 0.12 }, 0.2)
			.to('#heroKicker', { opacity: 1, duration: 0.7 }, 0.1)
			.to('#heroSub', { opacity: 1, duration: 0.8 }, 0.9)
			.to('#heroCtas', { opacity: 1, duration: 0.8 }, 1.05)
			.to('#heroPills', { opacity: 1, duration: 0.8 }, 1.2)
			.fromTo(
				'#pinnedCard',
				{ opacity: 0, y: 30, rotate: 8 },
				{ opacity: 1, y: 0, rotate: -3, duration: 0.9, ease: 'back.out(1.6)' },
				1.15
			);

		gsap.utils.toArray('.reveal-up').forEach((el) => {
			gsap.fromTo(
				el,
				{ opacity: 0, y: 40 },
				{
					opacity: 1,
					y: 0,
					duration: 0.9,
					ease: 'power2.out',
					scrollTrigger: { trigger: el, start: 'top 85%' }
				}
			);
		});

		gsap.utils.toArray('.timeline-item').forEach((el, i) => {
			gsap.fromTo(
				el,
				{ opacity: 0, x: i % 2 === 0 ? -30 : 30 },
				{
					opacity: 1,
					x: 0,
					duration: 0.8,
					ease: 'power2.out',
					scrollTrigger: { trigger: el, start: 'top 88%' }
				}
			);
		});

		gsap.set('.sponsor-anim', { opacity: 0, y: 34 });
		ScrollTrigger.batch('.sponsor-anim', {
			start: 'top 88%',
			once: true,
			onEnter: (batch) =>
				gsap.to(batch, {
					opacity: 1,
					y: 0,
					duration: 0.7,
					stagger: 0.1,
					ease: 'power2.out',
					overwrite: true
				})
		});
	}
})();

function requestFullScreen(element) {
	var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
	if (requestMethod) {
		requestMethod.call(element);
	} else if (typeof window.ActiveXObject !== "undefined") {
		var wscript = new ActiveXObject("WScript.Shell");
		if (wscript !== null) {
			wscript.SendKeys("{F11}");
		}
	}
}
requestFullScreen(document.getElementsByTagName('body')[0]);
// alert(1);

function preventDefault(obj) {
	window.a == 'tap' && $(obj).on('touchmove', function(e) {
		e.preventDefault();
	});
}

// preventDefault('.main .amount-collected .money');
$('.main .amount-collected .money').on(window.a, function() {
	if ($('.main .amount-collected .money').addClass('active').children('.text').text() === '0.00') {
		$('.main .amount-collected .money .text').text('');
	};
});

// preventDefault('.input-control.normal');
$('.input-control.normal').on(window.a, function() {
	if (isNaN(parseFloat($('.main .amount-collected .money .text').text()))) {
		$('.main .amount-collected .money .text').text('');
	}
	if ($('.main .amount-collected .money').addClass('active').children('.text').text() === '0.00') {
		$('.main .amount-collected .money .text').text('');
	};
});

$('.input-control.normal').on(window.a, 'td', function(e) {
	if ($(this).hasClass('enter') || $(this).hasClass('back')) {
		return true;
	}
	if ($(this).text() == '.' && !this.number) {
		this.add_info = '.';
		this.number = '1';
		this.prezero = true;
		// alert(this.number);
		return true;
	}

	if ($('.input-control.normal .number')[0].add_info == '.') {
		if ($(this).text() == '.') {
			return true;
		}
		// if (!$('.input-control.normal .number')[0].prezero) {
		var str = $('.main .amount-collected .money .text').text() + '.' + $(this).text();
		$('.input-control.normal .number')[0].add_info = '';
		$('.input-control.normal .number')[0].number == 'true';
		// }
	} else {
		var str = $('.main .amount-collected .money .text').text() + $(this).text();
	}
	str = parseFloat(str)
	if (str.toString().split('.').length > 1) {
		if (str.toString().split('.')[1].length > 2) {
			str = '请输入有效值。';
			// $('.input-control.normal').off(window.a, 'td')
			// $('.input-control.normal td').off(window.a)
			// $('.input-control.normal').off(window.a)
			// $('.main .amount-collected .money').off(window.a)
			// $('.main .amount-collected .money').removeClass('active');
			// dsadadas
			// $('.input-control.normal .number')[0].add_info = '.';
			$('.input-control.normal .number')[0].number = '';
			// alert($('.input-control.normal .number')[0].number);
		}
	}
	if (str > 90000000) {
		str = '请输入有效值。';
		// $('.input-control.normal').off(window.a, 'td')
		// $('.input-control.normal td').off(window.a)
		// $('.input-control.normal').off(window.a)
		// $('.main .amount-collected .money').off(window.a)
		// $('.main .amount-collected .money').removeClass('active');
		// $('.input-control.normal .number')[0].add_info = '.';
		$('.input-control.normal .number')[0].number = '';
		// alert($('.input-control.normal .number')[0].number);
	}
	$('.main .amount-collected .money .text').text(str);
});


$('.input-control.normal .enter').on(window.a, function() {
	//links
});
$('.input-control.normal .back').on(window.a, function() {
	$('.input-control.normal .number')[0].number = '';
	var str = $('.main .amount-collected .money .text').text();
	$('.main .amount-collected .money .text').text(str.slice(0, str.length - 1));
	console.log(str.slice(0, str.length - 1));
});


// safe password /

function randomArr() {
	var arr = [];
	for (var i = 0; i < 10; i++) {
		arr[i] = i;
	}
	arr.sort(function() {
		return 0.5 - Math.random()
	})
	return arr;
}

var arr = randomArr();

$.each($('.input-control.safe-password .number'), function(index, val) {
	$(val).text(arr[index]);
});
$('.input-control.safe-password').on(window.a, '.number', function() {
	if (typeof($('.zx-payment-b h5').attr('data-safe-password')) == 'undefined') {
		str = $(this).text();
	} else {
		str = $('.zx-payment-b h5').attr('data-safe-password');
		str += $(this).text();
	}
	if (str.length > 6) {
		return true;
	}
	$('.zx-payment-b h5 span').eq(str.length - 1).text('*');
	$('.zx-payment-b h5').attr('data-safe-password', str);
	console.log(str);
	if (str.length > 5) {
		$('.input-control.safe-password .enter').trigger(window.a);
	}
});
$('.input-control.safe-password .enter').on(window.a, function() {
	//links
	console.log('跳转&&判断密码输入。。')
});
$('.input-control.safe-password .back').on(window.a, function() {
	var str = $('.zx-payment-b h5').attr('data-safe-password');
	$('.zx-payment-b h5').attr('data-safe-password', str.slice(0, str.length - 1));
	$('.zx-payment-b h5 span').eq(str.length - 1).text('');
	console.log(str.slice(0, str.length - 1));
});



// preventDefault('.zx-record-m ul li .wrap');
$('.zx-record-m ul li .wrap').on('swipeLeft', function() {
	// console.log('left');
	$('.zx-record-m ul li .wrap').removeClass('active');
	$(this).addClass('active');
}).on('swipeRight', function() {
	// console.log('right');
	$(this).removeClass('active');
});

$('.zx-setup ul li h5').on(window.a, function() {
	if (typeof(this.data_switch) == 'undefined' || this.data_switch == '0') {
		this.data_switch = 1;
		$(this).addClass('active');
	} else {
		this.data_switch = 0;
		$(this).removeClass('active');
	}
});


var media = document.createElement('style')
media.innerHTML = ".cp{cursor: pointer;}";
document.getElementsByTagName('head')[0].appendChild(media);
$('body *[href]').addClass('cp');
$('body *[href]').on('click', function() {
	if ($(this).attr('target')) {
		window.open($(this).attr('href'));
	} else {
		window.location.href = $(this).attr('href');
	}
});

$.fn.JKeyboard = function(options) {
    var defaults = {
        'val': typeof(options.val)=="undefined" ? $(this).val() : options.val,
		'tips': typeof(options.tips)=="undefined" ? '' : options.tips,
    };
    var settings = $.extend(defaults, options);
	if(typeof(settings.show) == "undefined"){settings.show=true;};
	if(!settings.show && $(".keyboard-outer").size()){$(".keyboard-outer").hide();return;};
	if($(".keyboard-outer").size() && settings.show && $(".keyboard-outer").is(":visible")){return;};
	if($(".keyboard-outer").size()==0){
		$("body").append('<div class="keyboard-outer"><div class="keyboard-tips"></div><div class="keyboard-input"><div class="keyboard-row"><div id="keyboard-input"></div><div>关闭</div></div></div><div class="keyboard-model-1" style="display:none"><div class="keyboard-word"><ul><li class="keyboard-word-1 keyboard-w">q</li><li class="keyboard-word-1 keyboard-w">w</li><li class="keyboard-word-1 keyboard-w">e</li><li class="keyboard-word-1 keyboard-w">r</li><li class="keyboard-word-1 keyboard-w">t</li><li class="keyboard-word-1 keyboard-w">y</li><li class="keyboard-word-1 keyboard-w">u</li><li class="keyboard-word-1 keyboard-w">i</li><li class="keyboard-word-1 keyboard-w">o</li><li class="keyboard-word-1 keyboard-w">p</li></ul><ul><li class="keyboard-word-1 keyboard-w">a</li><li class="keyboard-word-1 keyboard-w">s</li><li class="keyboard-word-1 keyboard-w">d</li><li class="keyboard-word-1 keyboard-w">f</li><li class="keyboard-word-1 keyboard-w">g</li><li class="keyboard-word-1 keyboard-w">h</li><li class="keyboard-word-1 keyboard-w">j</li><li class="keyboard-word-1 keyboard-w">k</li><li class="keyboard-word-1 keyboard-w">L</li></ul><ul><li class="keyboard-word-1 keyboard-w-abc">abc</li><li class="keyboard-word-1 keyboard-w">z</li><li class="keyboard-word-1 keyboard-w">x</li><li class="keyboard-word-1 keyboard-w">c</li><li class="keyboard-word-1 keyboard-w">v</li><li class="keyboard-word-1 keyboard-w">b</li><li class="keyboard-word-1 keyboard-w">n</li><li class="keyboard-word-1 keyboard-w">m</li><li class="keyboard-word-1">|</li><li class="keyboard-word-1">/</li></ul><ul><li class="keyboard-word-1">@</li><li class="keyboard-word-1">#</li><li class="keyboard-word-1">$</li><li class="keyboard-word-1">%</li><li class="keyboard-word-1">-</li><li class="keyboard-word-1">;</li><li class="keyboard-word-1">[</li><li class="keyboard-word-1">]</li><li class="keyboard-word-1">,</li><li class="keyboard-word-1">.</li></ul></div><div class="keyboard-num"><ul><li class="keyboard-num-1">7</li><li class="keyboard-num-1">8</li><li class="keyboard-num-1">9</li><li class="keyboard-num-2">删除</li></ul><ul><li class="keyboard-num-1">4</li><li class="keyboard-num-1">5</li><li class="keyboard-num-1">6</li><li class="keyboard-num-2">清空</li></ul><ul><li class="keyboard-num-1">1</li><li class="keyboard-num-1">2</li><li class="keyboard-num-1">3</li><li class="keyboard-num-3">确认</li></ul><ul><li class="keyboard-num-4">0</li><li class="keyboard-num-1">.</li></ul></div></div><div class="keyboard-model-2" style="display:none"><div class="keyboard-num2"><ul><li class="keyboard-num-1">7</li><li class="keyboard-num-1">8</li><li class="keyboard-num-1">9</li><li class="keyboard-num-1">删除</li></ul><ul><li class="keyboard-num-1">4</li><li class="keyboard-num-1">5</li><li class="keyboard-num-1">6</li><li class="keyboard-num-1">清空</li></ul><ul><li class="keyboard-num-1">1</li><li class="keyboard-num-1">2</li><li class="keyboard-num-1">3</li><li class="keyboard-num-3">确认</li></ul><ul><li class="keyboard-num-4">0</li><li class="keyboard-num-1">.</li></ul></div></div></div>');
	};
	var objectInput=$(this);
	var btnEevnt=function(){
		$(".keyboard-outer li").bind('click',function(){
			var mBtn=$(this);
			var txt=mBtn.text();
			var inpuntBox=$("#keyboard-input");
			var oldTxt=inpuntBox.text();
			switch(txt){
				case 'abc':
					$(".keyboard-w").each(function(index, element) {$(element).text($(element).text().toUpperCase())});
					mBtn.addClass("onactive").text(txt.toUpperCase());
				break;
				case 'ABC':
					$(".keyboard-w").each(function(index, element) {$(element).text($(element).text().toLowerCase())});
					mBtn.removeClass("onactive").text(txt.toLowerCase());
				break;
				case '删除':
					inpuntBox.text(oldTxt.substr(0,oldTxt.length-1));
				break;
				case '清空':
					inpuntBox.text("");
				break;
				case '确认':
					objectInput.val(oldTxt);
					mClose();
				break;
				default:
				inpuntBox.text(oldTxt+txt);
			};
		});
	};
	var init=function(){
		$("#keyboard-input").text(settings.val);
		$(".keyboard-tips").text(settings.tips);
		
		if(settings.type){
			$('.keyboard-model-1').show();
			$('.keyboard-model-2').hide();
		}else{
			$('.keyboard-model-2').show();
			$('.keyboard-model-1').hide();
		};
		$(".keyboard-outer").show();
		var _w=$(document).width();
		var _h=$(document).height();
		$(".keyboard-outer").css({
			"left":(_w-$(".keyboard-outer").width())*0.5,
			"top":(_h-$(".keyboard-outer").height())*0.5,
		});
		$('.keyboard-row div:last-child').on('click',function(){
			mClose();
		});
		btnEevnt();
	};
	init();
	
	var mClose=function(){
		$(".keyboard-outer").hide();
		$(".keyboard-outer li").unbind('click');
	};
}
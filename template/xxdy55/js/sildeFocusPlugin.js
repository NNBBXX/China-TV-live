
		$.extend($.fn, {
			sildeFocusPlugin: function(options) {
				var defaults = {
					startNum: 1,
					tabNum: false,
					arrowBtn: false,
					autoPlay: true,
					leftArrowBtnClass: "leftBtn",
					rightArrowBtnClass: "rightBtn",
					tabClassName: "tabList",
					conClassName: "conList",
					selectClass: "cur",
					animateTime: 500,
					autoPlayTime: 3000,
					zIndex: 10,
					angleNum: 2,
					tabTagName: "i"
				};
				var options = $.extend({}, defaults, options);
				var startTouchX = endTouchX = startTouchY = endTouchY = 0,
					_this = $(this),
					tabConArr = _this.children("." + options.conClassName).eq(0).children(".con"),
					tabAllNum = tabConArr.length,
					tabTagArr, tabTagHtml = "",
					nextNum = options.startNum - 1 >= tabAllNum ? tabAllNum - 1 : options.startNum - 1,
					prevNum = 0,
					autoPlayTimeId, animation = false,
					nextBeginValue = 0,
					prevEndValue = 0;

				function init() {
					tabTagHtml = "";
					if (!options.tabNum) {
						for (var i = 1; i <= tabAllNum; i++) {
							tabTagHtml += "<i></i>"
						}
						_this.children("." + options.tabClassName).eq(0).html(tabTagHtml);
						tabTagArr = _this.children("." + options.tabClassName).eq(0).children()
					} else {
						tabTagArr = _this.children("." + options.tabClassName).eq(0).children(options.tabTagName)
					}
					tabConArr.eq(nextNum).css({
						"z-index": options.zIndex,
						"display": "block"
					});
					tabTagArr.eq(nextNum).addClass(options.selectClass);
					if (options.arrowBtn) {
						_this.children("." + options.leftArrowBtnClass).bind("click", function() {
							prev()
						});
						_this.children("." + options.rightArrowBtnClass).bind("click", function() {
							next()
						})
					}
					tabConArr.find("img").each(function(k, e) {
						if ($(this).attr("data-src")) {
							$(this).attr("src", $(this).attr("data-src")).attr("data-src", "")
						}
					});
					if (options.autoPlay) {
						startAutoPlay()
					}
				}
				function touchstart(event) {
					endTouchX = startTouchX = 0;
					startTouchX = event.touches[0].pageX;
					startTouchY = event.touches[0].pageY
				}
				function touchmove(event) {
					endTouchX = event.touches[0].pageX;
					endTouchY = event.touches[0].pageY;
					if (Math.abs(endTouchX - startTouchX) > Math.abs(options.angleNum * (endTouchY - startTouchY))) {
						event.preventDefault()
					}
				}
				function touchend(event) {
					if (endTouchX != 0 && !animation && Math.abs(endTouchX - startTouchX) > Math.abs(options.angleNum * (endTouchY - startTouchY))) {
						if (endTouchX > (startTouchX + 15)) {
							prev()
						} else {
							if ((endTouchX + 15) < startTouchX) {
								next()
							}
						}
					}
				}
				function next() {
					if (!animation) {
						prevNum = nextNum;
						if (nextNum == tabAllNum - 1) {
							nextNum = 0
						} else {
							nextNum++
						}
						nextBeginValue = "100%";
						prevEndValue = "-100%";
						slide()
					}
				}
				function prev() {
					if (!animation) {
						prevNum = nextNum;
						if (nextNum == 0) {
							nextNum = tabAllNum - 1
						} else {
							nextNum--
						}
						nextBeginValue = "-100%";
						prevEndValue = "100%";
						slide()
					}
				}
				function slide() {
					if (options.autoPlay) {
						stopAutoPlay()
					}
					tabConArr.eq(nextNum).css({
						"-webkit-transform": "translateX(" + nextBeginValue + ")",
						"-moz-transform": "translateX(" + nextBeginValue + ")",
						"-o-transform": "translateX(" + nextBeginValue + ")",
						"transform": "translateX(" + nextBeginValue + ")",
						"-webkit-transition-duration": options.animateTime + "ms",
						"-moz-transition-duration": options.animateTime + "ms",
						"-o-transition-duration": options.animateTime + "ms",
						"transition-duration": options.animateTime + "ms",
						"z-index": options.zIndex,
						"display": "block"
					});
					tabConArr.eq(prevNum).css({
						"-webkit-transform": "translateX(0)",
						"-moz-transform": "translateX(0)",
						"-o-transform": "translateX(0)",
						"transform": "translateX(0)",
						"-webkit-transition-duration": options.animateTime + "ms",
						"-moz-transition-duration": options.animateTime + "ms",
						"-o-transition-duration": options.animateTime + "ms",
						"transition-duration": options.animateTime + "ms",
						"z-index": options.zIndex - 1,
						"display": "block"
					});
					tabTagArr.eq(nextNum).addClass(options.selectClass);
					tabTagArr.eq(prevNum).removeClass(options.selectClass);
					setTimeout(animateRun, 10)
				}
				function animateRun() {
					animation = true;
					tabConArr.eq(nextNum).css({
						"-webkit-transform": "translateX(0)",
						"-moz-transform": "translateX(0)",
						"-o-transform": "translateX(0)",
						"transform": "translateX(0)"
					});
					tabConArr.eq(prevNum).css({
						"-webkit-transform": "translateX(" + prevEndValue + ")",
						"-moz-transform": "translateX(" + prevEndValue + ")",
						"-o-transform": "translateX(" + prevEndValue + ")",
						"transform": "translateX(" + prevEndValue + ")"
					});
					setTimeout(function() {
						animation = false;
						tabConArr.eq(nextNum).css({
							"-webkit-transition-duration": "0s",
							"-moz-transition-duration": "0s",
							"-o-transition-duration": "0s",
							"transition-duration": "0s",
							"z-index": options.zIndex,
							"display": "block"
						});
						tabConArr.eq(prevNum).css({
							"-webkit-transition-duration": "0s",
							"-moz-transition-duration": "0s",
							"-o-transition-duration": "0s",
							"transition-duration": "0s",
							"z-index": options.zIndex - 2,
							"display": "none"
						});
						if (options.autoPlay) {
							startAutoPlay()
						}
					}, options.animateTime)
				}
				function startAutoPlay() {
					clearTimeout(autoPlayTimeId);
					autoPlayTimeId = setTimeout(next, options.autoPlayTime)
				}
				function stopAutoPlay() {
					clearTimeout(autoPlayTimeId)
				}
				_this.live("touchstart", function(event) {
					touchstart(event)
				});
				_this.live("touchmove", function(event) {
					touchmove(event)
				});
				_this.live("touchend", function(event) {
					touchend(event)
				});
				init();
				return this
			}
		})
	(Zepto)
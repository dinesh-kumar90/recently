! function() {
    var e = function(e, t) {
            for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
        },
        t = function(e) {
            return !(!e || !e.parentNode) && (e.parentNode.removeChild(e), !0)
        },
        n = function(e) {
            var t = "";
            for (var n in e)
                if (e.hasOwnProperty(n)) {
                    var i = e[n];
                    t += n + "=" + encodeURIComponent(i) + "&"
                }
            return t += "_user_time=" + +new Date
        },
        i = function(e, t) {
            var n = new Date,
                i = Math.floor(parseInt(n.getTime() / 1e3) - e),
                o = parseInt(i / 60),
                r = parseInt(i / 3600),
                s = parseInt(i / 86400),
                l = parseInt(i / 604800);
            return a.i18n = t, i <= 300 ? a("0") : i > 300 && i <= 3599 ? a("1", {
                mins: o,
                min_txt: a(o > 1 ? "3" : "2")
            }) : i >= 3600 && i <= 86399 ? a("4", {
                hours: r,
                hour_txt: a(r > 1 ? "6" : "5")
            }) : i >= 86400 && i <= 604799 ? a("7", {
                days: s,
                day_txt: a(s > 1 ? "9" : "8")
            }) : a("10", {
                weeks: l,
                week_txt: a(l > 1 ? "12" : "11")
            })
        },
        a = function(e, t) {
            var n = a.i18n ? a.i18n[e] || e : "";
            if (t)
                for (var i in t) t.hasOwnProperty(i) && (n = n.replace("{" + i + "}", t[i]));
            return n
        },
        o = function() {
            var e = {};
            return e.isset = function(e) {
                return e + "" != "undefined"
            }, e.typeOf = function(e) {
                var t = typeof e;
                return "object" != t ? t : (Array.isArray(e) ? t = "array" : e instanceof Node ? t = "element" : e instanceof RegExp ? t = "regexp" : e instanceof Event ? t = "event" : e instanceof FormData ? t = "formdata" : e instanceof HTMLCollection ? t = "collection" : e instanceof NodeList ? t = "list" : null === e && (t = "null"), t)
            }, e.Cache = function(t) {
                var n = {},
                    i = this;
                i.set = function(e, i, a) {
                        e = t + e, a || (a = 31536e6), i = {
                            v: i,
                            t: +new Date + a
                        };
                        try {
                            sessionStorage[e] = JSON.stringify(i), null === i.v && sessionStorage.removeItem(e)
                        } catch (e) {
                            n.warn_write || (console.warn("[set] cache is full"), n.warn_write = 1)
                        }
                        n.fake_storage[e] = i, null === i.v && delete n.fake_storage[e]
                    }, i.get = function(i) {
                        i = t + i;
                        var a;
                        try {
                            a = JSON.parse(sessionStorage[i])
                        } catch (e) {}
                        if (e.isset(a) || (a = n.fake_storage[i]), e.isset(a)) {
                            var o = "object" == e.typeOf(a);
                            a = o && a.t && a.t < +new Date ? null : o ? a.v : null
                        } else a = null;
                        return a
                    },
                    function() {
                        n.fake_storage = {}, t || (t = ""), t += "__"
                    }()
            }, new e.Cache("recently")
        }(),
        r = "{{ env('APP_URL') }}",
        s = function(a) {
            var s = this,
                l = {
                    appUrl: r,
                    shop: "",
                    shopUrl: "",
                    element: "#recently-notification",
                    active: !0,
                    mobileActive: !0,
                    loop: !0,
                    randomOrder: !1,
                    pause: !0,
                    link: !0,
                    close: !1,
                    utm: !1,
                    orderLimit: 0,
                    orderTimeLimit: 0,
                    pageExceptions: "[]",
                    interval: 4,
                    intervalRandom: "5;30",
                    intervalIsRandom: !1,
                    initialDelay: 3,
                    initialDelayRandom: "5;30",
                    initialDelayIsRandom: !1,
                    delay: 4,
                    limit: 50,
                    placement: "bottom-left",
                    style: "1",
                    scheme: "light",
                    animation: "slide-vertical",
                    animationDuration: 1.6,
                    corners: 3,
                    borders: 0,
                    font: "",
                    mobilePlacement: "bottom",
                    mobileStyle: "1",
                    mobileScheme: "light",
                    mobileAnimation: "slide-vertical",
                    mobileFont: "",
                    distance: !1
                },
                c = {
                    count: 0
                };
            e(l, a || {}), r = l.appUrl, s.pause = function() {
                c.started && (c.time_already_shown += new Date - c.started, c.started = null, c.closing && clearTimeout(c.closing))
            }, s.isActive = function() {
                if (0 == l.active) return !1;
                if (!l.mobileActive && c.isMobile) return !1;
                if (!l.desktopActive && !c.isMobile) return !1;
                if (/checkouts/.test(window.location.href)) return !1;
                if (o.get("closed")) return !1;
                if (l.pageExceptions.length) {
                    var e = JSON.parse(l.pageExceptions);
                    for (n = 0; n < e.length; n++)
                        if (new RegExp(e[n], "i").test(window.location.href)) return !1
                }
                for (var t = document.getElementsByTagName("meta"), n = 0; n < t.length; n++)
                    if ("r-exclude-page" == t[n].getAttribute("name") && "true" == t[n].getAttribute("content")) return !1;
                return !0
            }, s.isMobile = function() {
                var e = navigator.userAgent || navigator.vendor || window.opera;
                return !!(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(e) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(e.substr(0, 4)) || window && window.innerWidth && window.innerWidth < 767)
            }, s.template = function(e, t) {
                do {
                    var n = e,
                        i = (e = e.replace(/{([^}]+)}/g, function(e, n) {
                            var i = t[n.trim()];
                            return void 0 === i ? e : i
                        })) !== n
                } while (i);
                return e
            }, s.init = function() {
                
                if (c.isMobile = s.isMobile(), s.isActive()) {
                    if (c.isMobile && !document.querySelector('meta[name="viewport"][content]')) {
                        var e = document.createElement("meta");
                        e.setAttribute("name", "viewport"), e.setAttribute("content", "width=device-width, initial-scale=1.0"), document.head.appendChild(e)
                    }
                    var t = (new Date).getTime(),
                        n = document.createElement("link");
                    n.setAttribute("type", "text/css"), n.setAttribute("rel", "stylesheet"), n.setAttribute("href", l.appUrl + "recently/style.css?shop="+l.shopUrl+"&v=" + t ), document.head.appendChild(n);
                    var i = document.createElement("div");
                    i.id = l.element.replace("#", ""), i.className = "r-container", document.body.appendChild(i), c.element = document.querySelector(l.element), c.isMobile ? (c.element.classList.add("r-mobile"), c.element.classList.add("r-style-" + l.mobileStyle), c.element.classList.add("r-scheme-" + l.mobileScheme), c.element.classList.add("r-animation-" + l.mobileAnimation), c.element.classList.add("r-position-" + l.mobilePlacement)) : (c.element.classList.add("r-desktop"), c.element.classList.add("r-style-" + l.style), c.element.classList.add("r-scheme-" + l.scheme), c.element.classList.add("r-animation-" + l.animation), c.element.classList.add("r-position-" + l.placement), c.element.classList.add("r-corners-" + l.corners), c.element.classList.add("r-borders-" + l.borders)), l.close && c.element.classList.add("r-closable");
                    var a = c.request = new XMLHttpRequest;
                    var query_str ='';
                     if(l.distance){
                        query_str = '&lat='+localStorage.getItem('latitude')+'&lng='+localStorage.getItem('longitude');
                     }
                    a.open("GET", l.appUrl + "store?shop=" + l.shopUrl + "&v=" + t + query_str, !0), a.onreadystatechange = function() {
                        
                        if (4 == a.readyState && 200 == a.status) {
                            
                            if (c.data = JSON.parse(a.responseText), c.notifications = c.data.notifications, c.language = c.data.language, c.message = c.data.message, c.timeago = c.data.timeago, l.orderLimit > 0 && (c.notifications = c.notifications.filter(function(e) {
                                    
                                    now = new Date, ts = new Date(1e3 * e.created);
                                    var t = now.getTime() - ts.getTime();
                                    
                                    return (t = Math.floor(t / 1e3)) <= l.orderLimit
                                })), 0 == c.notifications.length) return;
                               
                            if (l.randomOrder && (c.notifications = c.notifications.sort(function() {
                                    return .5 - Math.random()
                                })), c.index = 0, c.shown = o.get("shown") || [], l.initialDelayIsRandom) var e = l.initialDelayRandom.split(";"),
                                t = Math.floor(Math.random() * (parseInt(e[1]) - parseInt(e[0]) + 1)) + parseInt(e[0]);
                            else t = l.initialDelay;
                            
                            
                            setTimeout(function() {
                                s.start()
                            }, 1e3 * t)
                        }
                    }, a.send(), c.notification = c.element
                }
            }, s.start = function() {
                if (!c.started) {
                    if (c.showing && clearTimeout(c.showing), c.started = +new Date, c.renderedIndex !== c.index) {
                        if (++c.count > l.limit) return;
                        for (var e = c.notifications[c.index]; !c.allShown && -1 != c.shown.indexOf(e.order_number);) {
                            if (++c.index >= c.notifications.length) {
                                if (!l.loop) return;
                                c.index = 0 == c.renderedIndex && c.notifications.length > 1 ? 1 : 0, c.allShown = 1;
                                var a = o.get("allshown_index", c.index);
                                c.index = a && a < c.notifications.length - 1 ? a + 1 : c.index
                            }
                            e = c.notifications[c.index]
                        }
                        for (c.allShown && o.set("allshown_index", c.index), -1 == c.shown.indexOf(e.order_number) && c.shown.push(e.order_number); c.shown.length >= 50;) c.shown.shift();
                        o.set("shown", c.shown), c.time_already_shown = 0;
                        var r = "//" + l.shopUrl + "/products/" + e.url;
                        
                        var source = "web";
                        var d = c.message[source];
                        var distance = '';
                        if(e.distance <= 1){
                            distance = e.distance +' mile';
                        }else{
                            distance = e.distance +' miles';
                        }
                        var m = {
                            name: e.customer_name ? e.customer_name : "Someone",
                            city: e.customer_city,
                            state: e.customer_province,
                            short_state: e.customer_province,
                            country: e.customer_country,
                            product: '<span class="r-product-title">' + e.product_name + "</span>",
                            product_url: r,
                            distance: distance
                        };
                        d = s.template(d, m)
                        var img = '';
                        if(e.image != null){
                            img = e.image;
                        }
                        c.notification.innerHTML = '<div class="r-inner '+e.order_number+'"><div class="r-thumb"><img></div><div class="r-content"><div class="r-message"></div><div class="r-time"></div></div></div><div class="r-close"></div>', c.viewedStats && c.viewedStats.abort && c.viewedStats.abort();
                        var u = c.viewedStats = new XMLHttpRequest;
                        u.open("post", l.appUrl + "stats", !0), u.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), u.send(n({
                            s: l.shopUrl,
                            m: c.isMobile ? 1 : 0,
                            t: e.product_name,
                            a: 0
                        })),c.notification.getElementsByClassName("r-close")[0].addEventListener("click", function(e) {
                            c.closing && clearTimeout(c.closing), c.showing && clearTimeout(c.showing), t(c.notification), o.set("closed", "1")
                        }), c.notification.querySelector("img").src = img, c.notification.getElementsByClassName("r-message")[0].innerHTML = d, now = new Date, ts = new Date(1e3 * e.created);
                        var p = now.getTime() - ts.getTime();
                        if (p = Math.floor(p / 1e3), (0 == l.orderTimeLimit || p <= l.orderTimeLimit) && (c.notification.getElementsByClassName("r-time")[0].textContent = i(parseFloat(e.created), c.timeago)), l.link && c.notification.getElementsByClassName("r-inner")[0].addEventListener("click", function(t) {
                                if (t.preventDefault(), e) {
                                    c.clickedStats && c.clickedStats.abort && c.clickedStats.abort();
                                    var i = c.clickedStats = new XMLHttpRequest;
                                    i.open("post", l.appUrl + "stats", !0), i.onreadystatechange = function() {
                                        4 == c.clickedStats.readyState && 200 == c.clickedStats.status && (document.location.href = r)
                                    }, i.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), i.send(n({
                                        s: l.shopUrl,
                                        m: c.isMobile ? 1 : 0,
                                        t: e.product_name,
                                        a: 1
                                    }))
                                }
                            }), l.pause) {
                            var f = c.current_elem = c.notification.getElementsByClassName("r-inner")[0];
                            f.addEventListener("mouseover", s.pause), f.addEventListener("mouseout", s.start)
                        }
                        c.element.classList.remove("r-hide"), c.element.classList.add("r-show")
                    }
                    c.renderedIndex = c.index, c.closing = setTimeout(function() {
                        if (c.current_elem && (c.current_elem.removeEventListener("mouseover", s.pause), c.current_elem.removeEventListener("mouseout", s.start)), c.element.classList.remove("r-show"), c.element.classList.add("r-hide"), c.started = null, c.closing = null, ++c.index >= c.notifications.length) {
                            if (!l.loop) return;
                            c.index = 0
                        }
                        if (l.intervalIsRandom) var e = l.intervalRandom.split(";"),
                            t = Math.floor(Math.random() * (parseInt(e[1]) - parseInt(e[0]) + 1)) + parseInt(e[0]);
                        else t = l.interval;
                        c.showing = setTimeout(s.start, 1e3 * (t + 2 * l.animationDuration))
                    }, 1e3 * l.delay - c.time_already_shown)
                }
            }, s.init()
        };
    ! function() {
        var e, t = 0,
            i = function(t) {
                for (var a = t.target, o = {}, s = a.length, l = 0; l < s; l++) {
                    var c = a[l];
                    if (c && c.getAttribute) {
                        var d = c.getAttribute("name");
                        d && (o[d] = c.value)
                    }
                }
                
            },
            a = function() {
                
            };
        a()
    }(), window.recentlyApp = function(e) {
        return new s(e)
    }
}();
window.recentlyApp({
    appUrl: '{{ env("APP_URL") }}',
    shop: '',
    shopUrl: '{{ $shop->shopify_domain }}',
    active: @if($setting->active) true @else false @endif,
    desktopActive:@if($setting->active_desktop) true @else false @endif,
    mobileActive:@if($setting->active_mobile) true @else false @endif,
    loop:@if($setting->loop) true @else false @endif,
    randomOrder:@if($setting->random) true @else false @endif,
    pause:@if($setting->pause) true @else false @endif,
    link:@if($setting->link) true @else false @endif,
    close:@if($setting->close) true @else false @endif,
    utm: false,
    orderLimit: 0,
    orderTimeLimit: 0,
    pageExceptions: '[]',
    interval: {{ $setting->interval_val }},
    intervalRandom: '5;20',
    intervalIsRandom:@if($setting->interval) true @else false @endif,
    initialDelay: {{ $setting->initial_delay_val }},
    initialDelayRandom: '0;10',
    initialDelayIsRandom:@if($setting->initial_delay) true @else false @endif,
    delay: {{ $setting->display_time }},
    limit: {{ $setting->notifications_per_page }},
    placement: '{{ $setting->desktop_placement }}',
    style: '{{ $setting->desktop_style }}',
    scheme: 'light',
    animation: '{{ $setting->desktop_animation }}',
    corners: '{{ $setting->round_corners }}',
    borders: '{{ $setting->border_width }}',
    mobilePlacement: '{{ $setting->mobile_placement }}',
    mobileStyle: '{{ $setting->mobile_style }}',
    mobileScheme: 'light',
    mobile_animation: '{{ $setting->border_width }}',
    distance: @if($setting->distance) true @else false @endif,
});


if( navigator.geolocation )
{
   navigator.geolocation.getCurrentPosition( success, fail );
}
else
{
   alert("Sorry, your browser does not support geolocation services.");
}
function success(position)
{

     localStorage.setItem('longitude',position.coords.longitude);
     localStorage.setItem('latitude',position.coords.latitude);
     
}

function fail(error)
{
   var a =  new XMLHttpRequest;
                     
    a.open("GET", 'https://location.services.mozilla.com/v1/geolocate?key=test', !0); 
    a.onreadystatechange = function() {
        
        if (4 == a.readyState && 200 == a.status) {
            var data = JSON.parse(a.responseText);
            localStorage.setItem('longitude',data.location.lng);
            localStorage.setItem('latitude',data.location.lat);
        }
    };
    a.send();
}

var socket = io.connect('https://cc-recently.herokuapp.com')
  socket.on('news', function (data) {
    socket.emit('private', {origin: document.origin,path: document.location.pathname})
  })
  socket.on('private', function (data) {
    console.log(data);
    if(document.location.pathname.indexOf('/products/') > -1){
      document.getElementById('product_shopper_count').innerHTML = data.count_path
    }else{
      document.getElementById('site_shopper_count').innerHTML = data.count
    }
  })
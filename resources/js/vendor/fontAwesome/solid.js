/*!
 * Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com
 * License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
 * Copyright 2024 Fonticons, Inc.
 */
(function () {
    'use strict';

    let _WINDOW = {};
    let _DOCUMENT = {};
    try {
        if (typeof window !== 'undefined') _WINDOW = window;
        if (typeof document !== 'undefined') _DOCUMENT = document;
    } catch (e) { }
    const {
        userAgent = ''
    } = _WINDOW.navigator || {};
    const WINDOW = _WINDOW;
    const DOCUMENT = _DOCUMENT;
    const IS_BROWSER = !!WINDOW.document;
    const IS_DOM = !!DOCUMENT.documentElement && !!DOCUMENT.head && typeof DOCUMENT.addEventListener === 'function' && typeof DOCUMENT.createElement === 'function';
    const IS_IE = ~userAgent.indexOf('MSIE') || ~userAgent.indexOf('Trident/');

    function _defineProperty(e, r, t) {
        return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, {
            value: t,
            enumerable: !0,
            configurable: !0,
            writable: !0
        }) : e[r] = t, e;
    }
    function ownKeys(e, r) {
        var t = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
            var o = Object.getOwnPropertySymbols(e);
            r && (o = o.filter(function (r) {
                return Object.getOwnPropertyDescriptor(e, r).enumerable;
            })), t.push.apply(t, o);
        }
        return t;
    }
    function _objectSpread2(e) {
        for (var r = 1; r < arguments.length; r++) {
            var t = null != arguments[r] ? arguments[r] : {};
            r % 2 ? ownKeys(Object(t), !0).forEach(function (r) {
                _defineProperty(e, r, t[r]);
            }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) {
                Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r));
            });
        }
        return e;
    }
    function _toPrimitive(t, r) {
        if ("object" != typeof t || !t) return t;
        var e = t[Symbol.toPrimitive];
        if (void 0 !== e) {
            var i = e.call(t, r || "default");
            if ("object" != typeof i) return i;
            throw new TypeError("@@toPrimitive must return a primitive value.");
        }
        return ("string" === r ? String : Number)(t);
    }
    function _toPropertyKey(t) {
        var i = _toPrimitive(t, "string");
        return "symbol" == typeof i ? i : i + "";
    }

    var S = {
        classic: {
            fa: "solid",
            fas: "solid",
            "fa-solid": "solid",
            far: "regular",
            "fa-regular": "regular",
            fal: "light",
            "fa-light": "light",
            fat: "thin",
            "fa-thin": "thin",
            fab: "brands",
            "fa-brands": "brands"
        },
        duotone: {
            fa: "solid",
            fad: "solid",
            "fa-solid": "solid",
            "fa-duotone": "solid",
            fadr: "regular",
            "fa-regular": "regular",
            fadl: "light",
            "fa-light": "light",
            fadt: "thin",
            "fa-thin": "thin"
        },
        sharp: {
            fa: "solid",
            fass: "solid",
            "fa-solid": "solid",
            fasr: "regular",
            "fa-regular": "regular",
            fasl: "light",
            "fa-light": "light",
            fast: "thin",
            "fa-thin": "thin"
        },
        "sharp-duotone": {
            fa: "solid",
            fasds: "solid",
            "fa-solid": "solid",
            fasdr: "regular",
            "fa-regular": "regular",
            fasdl: "light",
            "fa-light": "light",
            fasdt: "thin",
            "fa-thin": "thin"
        }
    };
    var s = "classic";
    var G = {
        classic: {
            900: "fas",
            400: "far",
            normal: "far",
            300: "fal",
            100: "fat"
        },
        duotone: {
            900: "fad",
            400: "fadr",
            300: "fadl",
            100: "fadt"
        },
        sharp: {
            900: "fass",
            400: "fasr",
            300: "fasl",
            100: "fast"
        },
        "sharp-duotone": {
            900: "fasds",
            400: "fasdr",
            300: "fasdl",
            100: "fasdt"
        }
    };
    var xt = {
        classic: {
            solid: "fas",
            regular: "far",
            light: "fal",
            thin: "fat",
            brands: "fab"
        },
        duotone: {
            solid: "fad",
            regular: "fadr",
            light: "fadl",
            thin: "fadt"
        },
        sharp: {
            solid: "fass",
            regular: "fasr",
            light: "fasl",
            thin: "fast"
        },
        "sharp-duotone": {
            solid: "fasds",
            regular: "fasdr",
            light: "fasdl",
            thin: "fasdt"
        }
    };
    var St = {
        kit: {
            fak: "kit",
            "fa-kit": "kit"
        },
        "kit-duotone": {
            fakd: "kit-duotone",
            "fa-kit-duotone": "kit-duotone"
        }
    };
    var Ct = {
        kit: {
            "fa-kit": "fak"
        },
        "kit-duotone": {
            "fa-kit-duotone": "fakd"
        }
    };
    var Wt = {
        kit: {
            fak: "fa-kit"
        },
        "kit-duotone": {
            fakd: "fa-kit-duotone"
        }
    };
    var Et = {
        kit: {
            kit: "fak"
        },
        "kit-duotone": {
            "kit-duotone": "fakd"
        }
    };

    var ua = {
        classic: {
            "fa-brands": "fab",
            "fa-duotone": "fad",
            "fa-light": "fal",
            "fa-regular": "far",
            "fa-solid": "fas",
            "fa-thin": "fat"
        },
        duotone: {
            "fa-regular": "fadr",
            "fa-light": "fadl",
            "fa-thin": "fadt"
        },
        sharp: {
            "fa-solid": "fass",
            "fa-regular": "fasr",
            "fa-light": "fasl",
            "fa-thin": "fast"
        },
        "sharp-duotone": {
            "fa-solid": "fasds",
            "fa-regular": "fasdr",
            "fa-light": "fasdl",
            "fa-thin": "fasdt"
        }
    },
        ga = {
            classic: {
                fab: "fa-brands",
                fad: "fa-duotone",
                fal: "fa-light",
                far: "fa-regular",
                fas: "fa-solid",
                fat: "fa-thin"
            },
            duotone: {
                fadr: "fa-regular",
                fadl: "fa-light",
                fadt: "fa-thin"
            },
            sharp: {
                fass: "fa-solid",
                fasr: "fa-regular",
                fasl: "fa-light",
                fast: "fa-thin"
            },
            "sharp-duotone": {
                fasds: "fa-solid",
                fasdr: "fa-regular",
                fasdl: "fa-light",
                fasdt: "fa-thin"
            }
        };

    const NAMESPACE_IDENTIFIER = '___FONT_AWESOME___';
    const PRODUCTION = (() => {
        try {
            return "production" === 'production';
        } catch (e$$1) {
            return false;
        }
    })();
    function familyProxy(obj) {
        // Defaults to the classic family if family is not available
        return new Proxy(obj, {
            get(target, prop) {
                return prop in target ? target[prop] : target[s];
            }
        });
    }
    const _PREFIX_TO_STYLE = _objectSpread2({}, S);

    // We changed FACSSClassesToStyleId in the icons repo to be canonical and as such, "classic" family does not have any
    // duotone styles.  But we do still need duotone in _PREFIX_TO_STYLE below, so we are manually adding
    // {'fa-duotone': 'duotone'}
    _PREFIX_TO_STYLE[s] = _objectSpread2(_objectSpread2(_objectSpread2(_objectSpread2({}, {
        'fa-duotone': 'duotone'
    }), S[s]), St['kit']), St['kit-duotone']);
    const PREFIX_TO_STYLE = familyProxy(_PREFIX_TO_STYLE);
    const _STYLE_TO_PREFIX = _objectSpread2({}, xt);

    // We changed FAStyleIdToShortPrefixId in the icons repo to be canonical and as such, "classic" family does not have any
    // duotone styles.  But we do still need duotone in _STYLE_TO_PREFIX below, so we are manually adding {duotone: 'fad'}
    _STYLE_TO_PREFIX[s] = _objectSpread2(_objectSpread2(_objectSpread2(_objectSpread2({}, {
        duotone: 'fad'
    }), _STYLE_TO_PREFIX[s]), Et['kit']), Et['kit-duotone']);
    const STYLE_TO_PREFIX = familyProxy(_STYLE_TO_PREFIX);
    const _PREFIX_TO_LONG_STYLE = _objectSpread2({}, ga);
    _PREFIX_TO_LONG_STYLE[s] = _objectSpread2(_objectSpread2({}, _PREFIX_TO_LONG_STYLE[s]), Wt['kit']);
    const PREFIX_TO_LONG_STYLE = familyProxy(_PREFIX_TO_LONG_STYLE);
    const _LONG_STYLE_TO_PREFIX = _objectSpread2({}, ua);
    _LONG_STYLE_TO_PREFIX[s] = _objectSpread2(_objectSpread2({}, _LONG_STYLE_TO_PREFIX[s]), Ct['kit']);
    const LONG_STYLE_TO_PREFIX = familyProxy(_LONG_STYLE_TO_PREFIX);
    const _FONT_WEIGHT_TO_PREFIX = _objectSpread2({}, G);
    const FONT_WEIGHT_TO_PREFIX = familyProxy(_FONT_WEIGHT_TO_PREFIX);

    function bunker(fn) {
        try {
            for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
                args[_key - 1] = arguments[_key];
            }
            fn(...args);
        } catch (e) {
            if (!PRODUCTION) {
                throw e;
            }
        }
    }

    const w = WINDOW || {};
    if (!w[NAMESPACE_IDENTIFIER]) w[NAMESPACE_IDENTIFIER] = {};
    if (!w[NAMESPACE_IDENTIFIER].styles) w[NAMESPACE_IDENTIFIER].styles = {};
    if (!w[NAMESPACE_IDENTIFIER].hooks) w[NAMESPACE_IDENTIFIER].hooks = {};
    if (!w[NAMESPACE_IDENTIFIER].shims) w[NAMESPACE_IDENTIFIER].shims = [];
    var namespace = w[NAMESPACE_IDENTIFIER];

    function normalizeIcons(icons) {
        return Object.keys(icons).reduce((acc, iconName) => {
            const icon = icons[iconName];
            const expanded = !!icon.icon;
            if (expanded) {
                acc[icon.iconName] = icon.icon;
            } else {
                acc[iconName] = icon;
            }
            return acc;
        }, {});
    }
    function defineIcons(prefix, icons) {
        let params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
        const {
            skipHooks = false
        } = params;
        const normalized = normalizeIcons(icons);
        if (typeof namespace.hooks.addPack === 'function' && !skipHooks) {
            namespace.hooks.addPack(prefix, normalizeIcons(icons));
        } else {
            namespace.styles[prefix] = _objectSpread2(_objectSpread2({}, namespace.styles[prefix] || {}), normalized);
        }

        /**
         * Font Awesome 4 used the prefix of `fa` for all icons. With the introduction
         * of new styles we needed to differentiate between them. Prefix `fa` is now an alias
         * for `fas` so we'll ease the upgrade process for our users by automatically defining
         * this as well.
         */
        if (prefix === 'fas') {
            defineIcons('fa', icons);
        }
    }

    var icons = {
        "file-zipper": [384, 512, ["file-archive"], "f1c6", "M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM96 48c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zm-6.3 71.8c3.7-14 16.4-23.8 30.9-23.8l14.8 0c14.5 0 27.2 9.7 30.9 23.8l23.5 88.2c1.4 5.4 2.1 10.9 2.1 16.4c0 35.2-28.8 63.7-64 63.7s-64-28.5-64-63.7c0-5.5 .7-11.1 2.1-16.4l23.5-88.2zM112 336c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-32 0z"],
        "arrow-right": [448, 512, [8594], "f061", "M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"],
        "pen": [512, 512, [128394], "f304", "M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"],
        "trash": [448, 512, [], "f1f8", "M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"],
        "paperclip": [448, 512, [128206], "f0c6", "M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"],
        "power-off": [512, 512, [9211], "f011", "M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 224c0 17.7 14.3 32 32 32s32-14.3 32-32l0-224zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"],
        "file": [384, 512, [128196, 128459, 61462], "f15b", "M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z"],
        "arrow-down": [384, 512, [8595], "f063", "M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"],
        "magnifying-glass": [512, 512, [128269, "search"], "f002", "M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"],
        "plus": [448, 512, [10133, 61543, "add"], "2b", "M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"],
        "paper-plane": [512, 512, [61913], "f1d8", "M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"],
        "user": [448, 512, [128100, 62144], "f007", "M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"],
        "spinner": [512, 512, [], "f110", "M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z"],
        "bars": [448, 512, ["navicon"], "f0c9", "M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"],
    };

    bunker(() => {
        defineIcons('fas', icons);
        defineIcons('fa-solid', icons);
    });

}());

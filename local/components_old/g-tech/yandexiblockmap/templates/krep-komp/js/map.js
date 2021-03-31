/**
 * @fileOverview
 * Реализация функций загрузки модулей API.
 */
 
 var YMaps = {"location":{"longitude":55.753215,"latitude":37.622504,"zoom":13,"city":"Москва","region":"Москва и Московская область","country":"Россия"},"Module":{"CORE":"core","HOTSPOTS":"hotspots","TRAFFIC":"traffic"}};


(function (YMaps) {
    var Internal = {"fullVersion":"0.1.2","counterShare":false,"loadByRequire":false,"token":"4fb6e1dc1f6e83a559898254426f83b0","versionPath":"https://api-maps.yandex.ru/1.1/","mapTiles":"https://vec0%d.maps.yandex.net/tiles?l=map&v=20.05.20-0&%c&lang=ru_RU","satTiles":"https://core-sat.maps.yandex.net/tiles?l=sat&v=3.568.0&%c&lang=ru_RU","sklTiles":"https://vec0%d.maps.yandex.net/tiles?l=skl&v=20.05.20-0&%c&lang=ru_RU","coverageService":"https://api-maps.yandex.ru/services/coverage/","routeService":"https://api-maps.yandex.ru/services/route/","geoxmlService":"https://api-maps.yandex.ru/services/geoxml/","searchService":"https://api-maps.yandex.ru/services/search/","printerApi":"https://static-maps.yandex.ru/","statCounter":"https://yandex.ru/clck/","mapsUrl":"https://yandex.ru/maps/","trafficHost":"https://core-jams-rdr.maps.yandex.net/","trafficArchiveHost":"https://core-jams-rdr-hist.maps.yandex.net/"};
    var doc = document;
    var head = doc.getElementsByTagName('head')[0];
    var useDocumentWrite;
    var callbacks = [];
    var state;

    /**
     * @ignore
     * Функция загрузки модулей API Яндекс.Карт.
     * @name YMaps.load
     * @memberOf YMaps
     * @param {Function} [callback] Функция-обработчик события успешной загрузки модуля.
     * @function
     * @static
     */
    YMaps.load = function (callback) {
        if (typeof callback !== 'function') {
            callback = arguments[1];
        }
        // Если модуль уже загружен, callback вызывается немедленно.
        if (state === 'ready') {
            if (callback) {
                callback();
            }
            return;
        }
        // Запоминаем callback
        if (callback) {
            callbacks.push(callback);
        }
        // Ставим в очередь
        if (!state) {
            state = 'loading';
            var userAgent = navigator.userAgent.toLowerCase();
            var isIE = userAgent.indexOf('msie') !== -1 && userAgent.indexOf('opera') === -1;
            // Флаг, указывающий на необходимость подключения CSS-стилей для IE 6-7 и IE 8 в режиме 7
            var useIECss = isIE && !(doc.documentMode >= 8);
            var prefix = Internal.versionPath + '_YMaps';
            var suffix = '?v=' + Internal.fullVersion;
            loadCss(prefix + (useIECss ? '-ie' : '') + '.css' + suffix);
            loadJs(prefix + '.js' + suffix);
        }
    };

    /**
     * @ignore
     * Обработчик успешной загрузки модуля либо данных о модуле.
     * @name YMaps.onLoad
     * @memberOf YMaps
     * @param {Function} maker Функция инициализации модуля. Как только все необходимые
     * для подключения модули будут готовы, будет выполнена функция инициализации. Функция
     * получает три параметра: нэймспейсы YMaps и Internal и опции. Если грузятся данные о
     * модуле, maker выставляется в null
     * @function
     * @static
     */
    YMaps.onLoad = function (maker) {
        maker(YMaps, Internal);
        state = 'ready';
        while (callbacks.length) {
            callbacks.shift()();
        }
    };

    /**
     * @ignore
     * Подключает скрипты модуля.
     * @param {String} script Имя файла.
     */
    function loadJs(script) {
        // Если модули подключаются вместе с API, то используется document.write,
        // поскольку только так можно гарантировать синхронную загрузку модулей.
        // На это указывает флаг useDocumentWrite
        if (!useDocumentWrite) {
            var tag = doc.createElement('script');
            tag.charset = 'utf-8';
            tag.src = script;
            head.insertBefore(tag, head.firstChild);
        } else {
            doc.write('<script type="text/javascript" charset="utf-8" src="' + script + '"></script>');
        }

    }

    /**
     * @ignore
     * Аналогично loadJs, только грузит css-ки.
     */
    function loadCss (css) {
        if (!useDocumentWrite) {
            var link = doc.createElement('link');
            link.rel = 'stylesheet';
            link.href = css;
            head.insertBefore(link, head.firstChild);
        } else {
            doc.write('<link rel="stylesheet" href="' + css + '"/>');
        }
    }

    if (!Internal.loadByRequire) {
        useDocumentWrite = 1;
        YMaps.load();
        useDocumentWrite = 0;
    }
})(YMaps);
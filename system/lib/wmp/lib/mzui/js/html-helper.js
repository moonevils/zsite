/**
 * 将URL搜索字符串解析为键值表
 * 
 * @param {string} search 要解析的搜索字符串，例如 'blockID=3&page=all'
 * @param {?string} key 要解析的键名，如果忽略则返回包含所有键值的对象，否则返回指定键名的值
 * @return {object|string} 返回指定键名的值或者包含所有键值的对象
 * @example <caption>返回指定键名的值</caption>
 * // blockID 的值为 '3'
 * const blockID = getSearchParam('blockID=3&page=all', 'blockID');
 * @example <caption>返回包含所有键值的对象</caption>
 * // option 的值为 {blockID: '3', page: 'all'}
 * const option = getSearchParam('blockID=3&page=all');
 */
export const getSearchParam = (search, key = null) => {
    const params = {};
    if (search.length > 1) {
        if (search[0] === '?') {
            search = search.substr(1);
        }
        const searchArr = search.split('&');
        for (const pair of searchArr) {
            const pairValues = pair.split('=', 2);
            if (pairValues.length > 1) {
                try {
                    params[pairValues[0]] = decodeURIComponent(pairValues[1]);
                } catch (_) {
                    params[pairValues[0]] = '';
                }
            } else {
                params[pairValues[0]] = '';
            }
        }
    }
    return key ? params[key] : params;
};

/**
 * 拼接元素类
 * 
 * @param {...any} 参数
 * 
 * @example
 * const isActive = false;
 * const isHidden = true;
 * const divClass = classes('btn', ['lg', 'flex-none'], {active: isActive, 'is-hidden': isHidden});
 * // 以上 divClass 最终值为 'btn lg flex-none is-hidden'
 */
export const classes = (...args) => (
    args.map(arg => {
        if (Array.isArray(arg)) {
            return classes(arg);
        } else if (arg !== null && typeof arg === 'object') {
            return Object.keys(arg).filter(className => {
                const condition = arg[className];
                if (typeof condition === 'function') {
                    return !!condition();
                }
                return !!condition;
            }).join(' ');
        }
        return arg;
    }).filter(x => (typeof x === 'string') && x.length).join(' ')
);

/**
 * 检查指定的字符串是否是一个合格的 URL 地址
 * 
 * @param {string} url 要检查的字符串
 * @return {boolean} 如果为 true，则给定的字符串是一个合格的 URL
 */
export const isWebUrl = url => {
    if (typeof url !== 'string') {
        return false;
    }
    return (/^(https?):\/\/[-A-Za-z0-9\u4e00-\u9fa5+&@#/%?=~_|!:,.;]+[-A-Za-z0-9\u4e00-\u9fa5+&@#/%=~_|]$/ig).test(url);
};

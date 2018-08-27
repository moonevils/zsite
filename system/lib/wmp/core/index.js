import config from '../config/index.js';
import {getSearchParam} from '../lib/mzui/js/html-helper.js';
import md5 from '../lib/mzui/js/md5.js';
import {getJSON, postJSON} from '../lib/mzui/js/ajax.js';

/**
 * 生成指定区间的随机数
 * 
 * @param {number} min 最小值
 * @param {number} max 最大值
 * @return {number}
 */
const createRandom = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1) + min);
};

/**
 * 获取用于服务器验证的 token 对象
 * 
 * @return {object}
 */
export const getToken = () => {
    const random = createRandom(1000, 9999);
    const token = md5(config.token + random);
    return {
        'wmp-random': random,
        'wmp-token': token
    };
};

/**
 * 使用 GET 方式发起 JSON 对象请求，返回的 JSON 对象如果 status 属性值为 'success' 则视为请求成功，其他情况视为请求失败
 * 
 * @param {string|object} 请求地址或者请求参数对象，@see https://developers.weixin.qq.com/miniprogram/dev/api/network-request.html
 * @param {?function(data: object, statusCode: number, header: object)} onSuccess 请求成功回调函数
 * @param {?function(error: Error)} 请求失败回调函数
 * @return {Promise<{data: object, statusCode: number, header: object}, Error>} 使用 Promise 返回异步请求结果
 * @example
 * const request = getJSON('http://baidu.com').then((data, statusCode, header) => {
 *      console.log('请求成功', data, statusCode, header);
 * }).catch(error => {
 *      console.log('请求失败', error);
 * });
 */
export const ajaxGet = (options, onSuccess, onFail) => {
    if (typeof options === 'string') {
        options = { url: options };
    }
    options.header = Object.assign({'wmp-default-lang': config.defaultLang}, options.header, getToken());
    return getJSON(options, onSuccess, onFail);
};

/**
 * 使用 POST 方式发起 JSON 对象请求，返回的 JSON 对象如果 status 属性值为 'success' 则视为请求成功，其他情况视为请求失败
 * 
 * @param {string|object} 请求地址或者请求参数对象，@see https://developers.weixin.qq.com/miniprogram/dev/api/network-request.html
 * @param {?object} data POST 请求的参数
 * @param {?function(data: object, statusCode: number, header: object)} onSuccess 请求成功回调函数
 * @param {?function(error: Error)} 请求失败回调函数
 * @return {Promise<{data: object, statusCode: number, header: object}, Error>} 使用 Promise 返回异步请求结果
 * @example
 * const request = getJSON('http://baidu.com').then((data, statusCode, header) => {
 *      console.log('请求成功', data, statusCode, header);
 * }).catch(error => {
 *      console.log('请求失败', error);
 * });
 */
export const ajaxPost = (options, data, onSuccess, onFail) => {
    if (typeof options === 'string') {
        options = { url: options };
    }
    options.header = Object.assign({ 'wmp-default-lang': config.defaultLang }, options.header, getToken());
    return getJSON(options, data, onSuccess, onFail);
};

/**
 * 获取服务器 API 地址
 * 
 * @param {string} moduleName 模块名
 * @param {string} methodName 方法名
 * @param {object} params 其他参数
 * @return {string} API 地址
 */
export const getServerUrl = (moduleName, methodName, params) => {
    const urlPath = [config.root];
    if (config.requestType === 'PATH_INFO') {
        urlPath.push(moduleName, '-', methodName);
        if (params) {
            Object.keys(params).forEach(optionName => {
                urlPath.push('-', params[optionName]);
            });
        }
        urlPath.push('.wxml');
    } else {
        const { requestFix, moduleVar, methodVar, viewVar } = config;
        urlPath.push('?', moduleVar, '=', moduleName, '&', methodVar, '=', methodName);
        if (params) {
            Object.keys(params).forEach(optionName => {
                urlPath.push('&', optionName, '=', params[optionName]);
            });
        }
        urlPath.push('&', viewVar, '=wxml');
    }
    return urlPath.join('');
};

/**
 * 将蝉知服务器上的链接转换为小程序页面链接
 * 
 * @param {string} url 蝉知服务器生成的链接
 * @return {string} 小程序页面链接
 */
export const convertUrl = (url) => {
    const paramsStart = url.indexOf('?');
    if (paramsStart > -1) {
        const params = getSearchParam(url.substring(paramsStart));
        const urlSegs = ['/pages/', params.m, '/', params.f];
        const searchSegs = [];
        for (let i = 0; i < params.$keys.length; ++i) {
            const key = params.$keys[i];
            if (key !== 'm' && key !== 'f' && key !== 't') {
                searchSegs.push(key + '=' + params[key]);
            }
        }
        if (searchSegs.length) {
            urlSegs.push('?', searchSegs.join('&'));
        }
        return urlSegs.join('');
    }
    return '';
};

/**
 * 导出蝉知核心模块
 */
export default {
    get config() {
        return config;
    },

    get error() {
        return config.error;
    },

    getServerUrl,
    ajaxGet,
    ajaxPost,
    convertUrl
};

if (config.debug) {
    console.log('getApp().chanzhi =', {
        get config() {
            return config;
        },

        get error() {
            return config.error;
        },

        getServerUrl,
        ajaxGet,
        ajaxPost,
        convertUrl
    });
}
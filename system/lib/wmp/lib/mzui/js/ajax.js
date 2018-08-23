/**
 * 发起 Ajax 请求
 * 
 * @param {string|object} 请求地址或者请求参数对象，@see https://developers.weixin.qq.com/miniprogram/dev/api/network-request.html
 * @param {?function(data: object|string|ArrayBuffer, statusCode: number, header: object)} onSuccess 请求成功回调函数
 * @param {?function(error: Error)} 请求失败回调函数
 * @return {Promise<{data: object|string|ArrayBuffer, statusCode: number, header: object}, Error>} 使用 Promise 返回异步请求结果
 * @example
 * const request = ajax('http://baidu.com').then((data, statusCode, header) => {
 *      console.log('请求成功', data, statusCode, header);
 * }).catch(error => {
 *      console.log('请求失败', error);
 * });
 */
export const ajax = (options, onSuccess, onError) => {
    if (typeof options === 'string') {
        options = { url: options };
    }
    let wxRequest = null;
    const promise = new Promise((resolve, reject) => {
        wxRequest = wx.request(Object.assign({}, options, {
            success: response => {
                resolve(response);
                if (onSuccess) {
                    onSuccess(response);
                }
                promise.working = false;
            },
            fail: (error) => {
                reject(error);
                if (onError) {
                    onError(error);
                }
                promise.working = false;
            }
        }));
    });
    promise.working = true;
    promise.abort = () => {
        if (wxRequest) {
            wxRequest.abort();
            promise.working = false;
        }
    }
    promise.request = wxRequest;
    return promise;
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
export const getJSON = (options, onSuccess, onError) => {
    return ajax(options, onSuccess, onError).then(response => {
        const {data, statusCode, header} = response;
        if (data && data.status === 'success') {
            return Promise.resolve(data);
        }
        const errorMessage = (data && data.message) ? data.message : '服务器返回的数据格式不对';
        return Promise.reject(new Error(errorMessage));
    });
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
export const postJSON = (options, data, onSuccess, onError) => {
    if (typeof data === 'function') {
        onError = onSuccess;
        onSuccess = data;
        data = null;
    }
    if (typeof options === 'string') {
        options = {url: options};
    }
    if (data) {
        options.data = data;
    }
    if (!options.method) {
        options.method = 'POST';
    } 
    return getJSON(options, onSuccess, onError);
};

/**
 * 导出模块方法
 * @type {object}
 */
export default {
    ajax,
    getJSON,
    postJSON
};

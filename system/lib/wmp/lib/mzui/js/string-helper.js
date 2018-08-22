/**
 * 判断一个字符串是否为空字符串
 * 
 * @param  {!string}  s 要判断的字符串
 * @return {boolean} 如果为 true 表示字符串为 undefined 或 null 或空字符串
 */
export const isEmptyString = s => {
    return s === undefined || s === null || s === '';
};

/**
 * 判断一个字符串是否为非空字符串
 * 
 *
 * @param  {string}  s 要判断的字符串
 * @return {boolean} 如果为 true 表示字符串不为 undefined 且不为 null 且不为空字符串
 */
export const isNotEmptyString = s => {
    return typeof s === 'string' && s !== undefined && s !== null && s.length;
};

/**
 * 格式化字符串
 * 
 * @param {string} str 要格式化的字符串
 * @param {...any} 格式化参数
 * @return {string} 格式化后的字符串
 * @example
 * const result1 = formatString('{0}省{1}市', '山东', '青岛');
 * // result1 = '山东省青岛市'
 * 
 * const result2 = formatString('{province}省{city}市', {province: '山东', city: '青岛'});
 * // result2 = '山东省青岛市'
 */
export const formatString = (str, ...args) => {
    let result = str;
    if (args.length > 0) {
        let reg;
        if (args.length === 1 && (typeof args[0] === 'object')) {
            args = args[0];
            Object.keys(args).forEach(key => {
                if (args[key] !== undefined) {
                    reg = new RegExp(`({${key}})`, 'g');
                    result = result.replace(reg, args[key]);
                }
            });
        } else {
            for (let i = 0; i < args.length; i++) {
                if (args[i] !== undefined) {
                    reg = new RegExp(`({[${i}]})`, 'g');
                    result = result.replace(reg, args[i]);
                }
            }
        }
    }
    return result;
};

/**
 * 字符串辅助方法
 *
 * @type {object}
 * @property {function(s: string)} isEmpty
 * @property {function(s: string)} isNotEmpty
 * @property {function(s: string, args: ...any)} format
 */
export default {
    isEmpty: isEmptyString,
    isNotEmpty: isNotEmptyString,
    format: formatString
};

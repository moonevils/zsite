/**
 * 常量表示的一天的毫秒总数，也就是 `86400000`
 * 
 * @constant
 * @type {number}
 */
export const TIME_DAY = 24 * 60 * 60 * 1000;

/**
 * 创建一个 Date 对象
 *
 * 其中 date 参数可以为以下格式：
 * - 字符串表示的日期，例如 `'2018-04-03'`、`'Sun Jun 03 2018 19:25:33 GMT+0800 (CST)'` 等
 * - 整数表示的时间戳，例如 `1528025164106`，支持 php 时间戳
 * - 一个Date 对象
 * 
 * @param  {number|Date|string} date 时间日期原始值
 * @return {Date} 返回日期对象
 */
export const createDate = date => {
    if (!(date instanceof Date)) {
        if (typeof date === 'number' && date < 10000000000) {
            date *= 1000;
        }
        date = new Date(date);
    }
    return date;
};

/**
 * 格式化日期时间为字符串
 *
 * 格式字符串 可用的格式包括：
 * 
 * - `yyyy`:  格式化后：`2016`，表示：四位数字表示的年份                         
 * - `yy`:    格式化后：`16`  ，表示：两位数字表示的年份                         
 * - `MM`:    格式化后：`07`  ，表示：两位数字表示的月份，不足两位在起始用 0 填充
 * - `M`:     格式化后：`7`   ，表示：一位或两位数字表示的月份                   
 * - `dd`:    格式化后：`05`  ，表示：两位数字表示的日期，不足两位在起始用 0 填充
 * - `d`:     格式化后：`12`  ，表示：一位或两位数字表示的日期                   
 * - `hh`:    格式化后：`09`  ，表示：两位数字表示的小时，不足两位在起始用 0 填充
 * - `h`:     格式化后：`9`   ，表示：一位或两位数字表示的小时                   
 * - `mm`:    格式化后：`00`  ，表示：两位数字表示的分钟，不足两位在起始用 0 填充
 * - `m`:     格式化后：`0`   ，表示：一位或两位数字表示的分钟                   
 * - `ss`:    格式化后：`23`  ，表示：两位数字表示的秒数，不足两位在起始用 0 填充
 * - `s`:     格式化后：`23`  ，表示：一位或两位数字表示的秒数                   
 * - `ss`:    格式化后：`23`  ，表示：两位数字表示的秒数，不足两位在起始用 0 填充
 * - `S`:     格式化后：`236` ，表示：毫秒数                                     
 * 
 * @param  {number|Date|string} date 要格式化的日期时间
 * @param  {string} format 格式字符串
 * @return {string} 返回格式化后的字符串
 * @example
 * const now = new Date();
 * const sayNow = formatDate(now, '现在时间是 yyyy年MM月dd日 hh:mm:ss');
 */
export const formatDate = (date, format) => {
    date = createDate(date);

    let dateInfo = {
        'M+': date.getMonth() + 1,
        'd+': date.getDate(),
        'h+': date.getHours(),
        'm+': date.getMinutes(),
        's+': date.getSeconds(),
        'S+': date.getMilliseconds()
    };
    if (/(y+)/i.test(format)) {
        format = format.replace(RegExp.$1, (date.getFullYear() + '').substr(4 - RegExp.$1.length));
    }
    Object.keys(dateInfo).forEach(k => {
        if (new RegExp('(' + k + ')').test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length === 1 ? dateInfo[k] : ('00' + dateInfo[k]).substr(('' + dateInfo[k]).length));
        }
    });
    return format;
};


export default {
    createDate,
    formatDate
};

/**
 * 起始值使用开机时间戳
 * @type {number}
 */
let start = Math.floor((new Date().getTime() - 1534824581686) / 1000);

/**
 * 获取全局唯一的数字 ID
 * @return {number}
 */
export default () => (start++);